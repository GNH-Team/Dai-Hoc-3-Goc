// src/common/guards/roles.guard.ts
import {
    CanActivate, ExecutionContext, Injectable, UnauthorizedException
} from "@nestjs/common"
import { Observable } from "rxjs"

@Injectable()
export class RolesGuard implements CanActivate {
    canActivate(
        context: ExecutionContext,
    ): boolean | Promise<boolean> | Observable<boolean> {
        const request = context.switchToHttp().getRequest()
        // Giả lập xác thực: kiểm tra header 'Authorization'
        const authHeader = request.headers.authorization
        if (!authHeader || authHeader !== "Bearer mysecrettoken") {
            throw new UnauthorizedException("Không có quyền truy cập")
        }
        return true
    }
}
