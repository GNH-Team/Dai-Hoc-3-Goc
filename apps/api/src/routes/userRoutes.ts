import { FastifyInstance, FastifyPluginOptions } from "fastify"

import { createUser, getUsers } from "@/controllers/userController"

async function userRoutes(fastify: FastifyInstance, options: FastifyPluginOptions) {
    fastify.get("/", getUsers)
    fastify.post("/", createUser)
}

export default userRoutes
