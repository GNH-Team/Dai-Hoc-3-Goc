import { FastifyRequest, FastifyReply } from 'fastify';

export const getUsers = async (request: FastifyRequest, reply: FastifyReply) => {
  reply.code(201).send({hello: "getuser"});
};

export const createUser = async (request: FastifyRequest, reply: FastifyReply) => {
  reply.code(201).send({hello: "createuser"});
};
