// src/common/interceptors/logging.interceptor.ts
import {
    CallHandler, ExecutionContext, Injectable, NestInterceptor
} from "@nestjs/common"
import { Observable } from "rxjs"
import { tap } from "rxjs/operators"

@Injectable()
export class LoggingInterceptor implements NestInterceptor {
    intercept(context: ExecutionContext, next: CallHandler): Observable<any> {
        const req = context.switchToHttp().getRequest()
        const { method } = req
        const { url } = req
        console.log(`Incoming Request: ${method} ${url}`)

        const now = Date.now()
        return next
            .handle()
            .pipe(
                tap(() => console.log(`Response for ${method} ${url} - ${Date.now() - now}ms`)),
            )
    }
}
