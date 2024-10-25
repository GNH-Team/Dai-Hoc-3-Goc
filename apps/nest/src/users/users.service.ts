// src/users/users.service.ts
import { Injectable, NotFoundException } from "@nestjs/common"

import { CreateUserDto } from "./dto/create-user.dto"
import { UpdateUserDto } from "./dto/update-user.dto"

export interface User {
    id: number;
    name: string;
    email: string;
    password: string;
}

@Injectable()
export class UsersService {
    private users: User[] = []

    private idCounter = 1

    create(createUserDto: CreateUserDto): User {
        const newUser: User = {
            id: this.idCounter += 1,
            ...createUserDto,
        }
        this.users.push(newUser)
        return newUser
    }

    findAll(): User[] {
        return this.users
    }

    findOne(id: number): User {
        const user = this.users.find((u) => u.id === id)
        if (!user) throw new NotFoundException(`User with ID ${id} not found`)
        return user
    }

    update(id: number, updateUserDto: UpdateUserDto): User {
        const user = this.findOne(id)
        const updatedUser = { ...user, ...updateUserDto }
        const index = this.users.findIndex((u) => u.id === id)
        this.users[index] = updatedUser
        return updatedUser
    }

    remove(id: number): void {
        const index = this.users.findIndex((user) => user.id === id)
        if (index === -1) throw new NotFoundException(`User with ID ${id} not found`)
        this.users.splice(index, 1)
    }
}
