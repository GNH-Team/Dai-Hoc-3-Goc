import { ValidationPipe } from "@nestjs/common"
import { NestFactory } from "@nestjs/core"

import { AppModule } from "./app.module"

async function bootstrap() {
    const app = await NestFactory.create(AppModule)

    // Sử dụng ValidationPipe toàn cục
    // app.useGlobalPipes(new ValidationPipe({
    //     whitelist: true, // Loại bỏ các trường không được định nghĩa trong DTO
    //     forbidNonWhitelisted: true, // Bắn lỗi nếu có trường không được định nghĩa
    //     transform: true, // Tự động chuyển đổi kiểu dữ liệu
    // }))

    await app.listen(process.env.PORT ?? 3000)
}

bootstrap()
