// made by Claude AI
/**
 * ! script sử dụng để lọc các table, enum, reference từ file DBML schema khi plugin DBML của prisma tạo ra
 * ! chỉ giữ lại các table, enum, reference cần thiết để xem trên dbdiagram.io
 * ! loại bỏ các table không liên quan đến service API cho đỡ rối mắt
 */

// Import required modules
import * as fs from "fs"

import { SPLIT_MODEL } from "./main"

function cleanDBMLSchema(content: string, includeObject: string[]): string {
    // Tách nội dung thành các block, giữ nguyên cấu trúc của mỗi block
    const blocks = content.split(/(?=Table|Enum|Ref:)/).filter((block) => block.trim())

    // Lọc các block phù hợp
    const cleanedBlocks = blocks.filter((block) => {
        // Kiểm tra nếu block là table
        const tableMatch = block.match(/^Table\s+([^\s{]+)/)
        if (tableMatch) {
            const tableName = tableMatch[1]
            return includeObject.includes(tableName)
        }

        // Kiểm tra nếu block là enum
        const enumMatch = block.match(/^Enum\s+([^\s{]+)/)
        if (enumMatch) {
            const enumName = enumMatch[1]
            return includeObject.includes(enumName)
        }

        // Kiểm tra các reference
        // eslint-disable-next-line
        const refMatch = block.match(/^Ref:\s+([^.]+)\.([^>\s]+)\s*>\s*([^.]+)\.([^\s\[]+)/)
        if (refMatch) {
            // eslint-disable-next-line
            const [_, sourceTable, sourceField, targetTable, targetField] = refMatch
            return includeObject.includes(sourceTable) && includeObject.includes(targetTable)
        }

        return false
    })

    return cleanedBlocks.join("").trim()
}

const schemaFilePath = "./prisma/dbml/schema.dbml"
const outputPath = "./prisma/dbml/filtered_schema.dbml"

const schemaContent = fs.readFileSync(schemaFilePath, "utf8")
const cleanedSchema = cleanDBMLSchema(
    schemaContent,
    SPLIT_MODEL
)

// Join the filtered lines and write back to the file
fs.writeFileSync(outputPath, cleanedSchema, "utf8")
