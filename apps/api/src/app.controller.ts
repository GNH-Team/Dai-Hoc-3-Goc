import { Body, Controller, Get, Inject, Param, Post, Put } from '@nestjs/common';
import { PrismaService } from './prisma.service';

import { ENHANCED_PRISMA } from '@zenstackhq/server/nestjs';

@Controller()
export class AppController {
  constructor(
    @Inject(ENHANCED_PRISMA) private readonly prismaService: PrismaService,
  ) {}

}