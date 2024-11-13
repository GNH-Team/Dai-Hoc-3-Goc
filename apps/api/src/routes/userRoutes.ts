import { FastifyInstance, FastifyPluginOptions } from 'fastify';
import { getUsers, createUser } from '@/controllers/userController';

async function userRoutes(fastify: FastifyInstance, options: FastifyPluginOptions) {
  fastify.get('/', getUsers);
  fastify.post('/', createUser);
}

export default userRoutes;
