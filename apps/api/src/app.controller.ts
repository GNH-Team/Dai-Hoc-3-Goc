import {
    Body,
    Controller,
    Get,
    Inject,
    Param,
    Post,
    Put,
    UseInterceptors,
} from "@nestjs/common"
import { ENHANCED_PRISMA } from "@zenstackhq/server/nestjs"

import { LoggingInterceptor } from "./common/interceptors/logging.interceptor"
import { PrismaService } from "./prisma.service"

@Controller()
@UseInterceptors(LoggingInterceptor)
export class AppController {
    constructor(
        @Inject(ENHANCED_PRISMA) private readonly prismaService: PrismaService,
    ) {}

    @Post("users")
    async signup(@Body() userData: { name: string }) {
        return this.prismaService.g_users.create({ data: userData })
    }

    @Post("postsx")
    async createPost(@Body() postData: { post_title: string, post_content: string }) {
        return this.prismaService.posts.create({ data: postData })
    }

    @Get("users")
    async getAllUsers() {
        return this.prismaService.g_users.findMany({
            where: { },
            select: { user_email: true },
        })
    }

    @Get("posts")
    async getAllPosts() {
        return this.prismaService.g_posts.findMany({
            where: { ID: 1233 }
        })
    }

    @Get("postsx")
    async getAllPostsX() {
        return this.prismaService.posts.findMany({
            where: { }
        })
    }

    @Put("posts/publish/:id")
    async publishPost(@Param("id") id: string) {
        return this.prismaService.g_posts.update({
            where: { ID: Number(id) },
            data: { post_status: "published" },
        })
    }
}
