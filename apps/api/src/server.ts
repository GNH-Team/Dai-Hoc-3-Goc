import Fastify from 'fastify';
import userRoutes from './routes/userRoutes';
import {envConfig} from './env';

import { enhance } from '@zenstackhq/runtime';
import { ZenStackFastifyPlugin } from '@zenstackhq/server/fastify';
import prisma  from './db';

import fastifyStatic from '@fastify/static';
import path from 'node:path';

function getUserId(req: any) {
  // return parseInt(req.header('X-USER-ID')!);
  return 1;
}

// Gets a Prisma client bound to the current user identity
function getPrisma(req: any) {
  return enhance(prisma, {
      user: { id: getUserId(req) },
  });
}

const envToLogger = {
  development: {
    transport: {
      target: 'pino-pretty',
      options: {
        translateTime: 'HH:MM:ss Z',
        ignore: 'pid,hostname',
      },
    },
  },
  production: true,
  test: false,
}

const server = Fastify(
  {
    logger: envToLogger[envConfig.get('NODE_ENV')] ?? true // defaults to true if no entry matches in the map
  }
);

// Đăng ký plugin @fastify/static với Fastify
server.register(fastifyStatic, {
  root: path.join(process.cwd(), 'public'),
  prefix: '/public/',
  setHeaders: (res, path) => {
    // set CORS headers
    res.setHeader('Access-Control-Allow-Origin', '*');
  }
});

// serve OpenAPI at /api/model
server.register(ZenStackFastifyPlugin, {
  prefix: '/api/model',
  // getSessionUser extracts the current session user from the request, its
  // implementation depends on your auth solution
  getPrisma,
});

// Register routes
server.register(userRoutes, { prefix: '/api/users' });

server.get('/', async (request, reply) => {
  return 'Hello world'
})

// Start server
const start = async () => {
  try {
    // server.log.info(`Server is running at http://localhost:3355`);
    await server.listen({ port: envConfig.get('PORT'), host: 'localhost' });
  } catch (err) {
    server.log.error(err);
    process.exit(1);
  }
};

start();


