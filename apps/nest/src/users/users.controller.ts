// src/users/users.controller.ts
import {
    Body,
    Controller,
    Delete,
    Get,
    Param,
    Post,
    Put,
    UseGuards,
    UseInterceptors
} from "@nestjs/common"

import { RolesGuard } from "../common/guards/roles.guard"
import { LoggingInterceptor } from "../common/interceptors/logging.interceptor"
import { CreateUserDto } from "./dto/create-user.dto"
import { UpdateUserDto } from "./dto/update-user.dto"
import { User, UsersService } from "./users.service"

@Controller("usersx")
// @UseGuards(RolesGuard) // Sử dụng Guard
@UseInterceptors(LoggingInterceptor) // Sử dụng Interceptor
export class UsersController {
    constructor(private readonly usersService: UsersService) {}

    @Post()
    create(@Body() createUserDto: CreateUserDto): User {
        return this.usersService.create(createUserDto)
    }

    @Get()
    findAll(): User[] {
        return this.usersService.findAll()
    }

    @Get(":id")
    findOne(@Param("id") id: string): User {
        return this.usersService.findOne(+id)
    }

    @Put(":id")
    update(@Param("id") id: string, @Body() updateUserDto: UpdateUserDto): User {
        return this.usersService.update(+id, updateUserDto)
    }

    @Delete(":id")
    remove(@Param("id") id: string): void {
        this.usersService.remove(+id)
    }
}
