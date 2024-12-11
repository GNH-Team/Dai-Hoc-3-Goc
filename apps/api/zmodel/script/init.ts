/**
 * ! chỉ sử dụng 1 lần để init zenstack lần đầu tiên sau khi đã pull cấu trúc database bằng prisma db pull
 * ! các lần sau nếu muốn tách các schema ra thành các file riêng biệt thì sử dụng script re-split.ts, không cần sử dụng init.ts
 */

import * as fs from "fs"

import { splitZmodel } from "./main"

const firstTimeSchemaContent = fs.readFileSync("./schema.zmodel", "utf8")
fs.writeFileSync("./zmodel/wp-original.zmodel", firstTimeSchemaContent, "utf8")

// thực hiện tách các model cần nâng cấp bằng zenstack model
splitZmodel()
