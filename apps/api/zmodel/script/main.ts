// made by Claude AI
// thực hiện phân tách zenstack model schema thành các file schema riêng biệt
import * as fs from "fs"

// ! Danh sách các table, enum cần nâng cao bằng zenstack model để thêm các chức năng phân quyền
export const ENHANCE_MODEL = [
    "dg_users", "dg_usermeta", "dg_posts", "dg_postmeta", "dg_stm_lms_user_courses",
    "dg_stm_lms_user_lessons", "dg_stm_lms_user_points"
]

// eslint-disable-next-line
export const CUSTOM_MODEL = extractModelsAndEnums(fs.readFileSync("./zmodel/custom.zmodel", "utf8"))

export function split(schemaContent: string, splitModel: string[], include: boolean): string {
    // Tách nội dung thành các block, giữ nguyên cấu trúc của mỗi block
    const blocks = schemaContent.split(/(?=model |enum:)/).filter((block) => block.trim())

    // Lọc các block phù hợp
    const cleanedBlocks = blocks.filter((block) => {
        // Kiểm tra nếu block là table
        const tableMatch = block.match(/^model\s+([^\s{]+)/)
        if (tableMatch) {
            const tableName = tableMatch[1]
            return include ? splitModel.includes(tableName) : !splitModel.includes(tableName)
        }

        // Kiểm tra nếu block là enum
        const enumMatch = block.match(/^enum\s+([^\s{]+)/)
        if (enumMatch) {
            const enumName = enumMatch[1]
            return include ? splitModel.includes(enumName) : !splitModel.includes(enumName)
        }

        return false
    })

    return cleanedBlocks.join("").trim()
}

export function splitZmodel() {
    const originalSchemaContent = fs.readFileSync("./zmodel/wp-original.zmodel", "utf8")

    // tách các table wordpress cần thiết để custom lại schema cho service API
    const enhanceSchema = split(
        originalSchemaContent,
        ENHANCE_MODEL,
        true
    )
    fs.writeFileSync("./zmodel/wp-enhance.zmodel", enhanceSchema, "utf8")
    fs.writeFileSync("./zmodel/wp-enhance-original.zmodel", enhanceSchema, "utf8") // file dùng để backup khi cần xem lại schema gốc

    // tách các table wordpress không sử dụng trong service API ra một schema riêng để tránh chỉnh sửa nhầm
    const noneEnhanceSchema = split(
        originalSchemaContent,
        ENHANCE_MODEL.concat(CUSTOM_MODEL),
        false
    )
    fs.writeFileSync("./zmodel/wp-none-enhance.zmodel", noneEnhanceSchema, "utf8")

    // ghi đè lên file schema.zmodel
    fs.writeFileSync("./schema.zmodel", fs.readFileSync("./zmodel/zmodel.template", "utf8"), "utf8")
}

export function extractModelsAndEnums(fileContent: string): string[] {
    // Biểu thức chính quy để tìm các tên model
    const modelRegex = /model\s+(\w+)/g
    // Biểu thức chính quy để tìm các tên enum
    const enumRegex = /enum\s+(\w+)/g

    const models: string[] = []
    const enums: string[] = []

    let match: RegExpExecArray | null

    // Trích xuất các tên model
    // eslint-disable-next-line
    while ((match = modelRegex.exec(fileContent)) !== null) {
        models.push(match[1])
    }

    // Trích xuất các tên enum
    // eslint-disable-next-line
    while ((match = enumRegex.exec(fileContent)) !== null) {
        enums.push(match[1])
    }

    return models.concat(enums)
}
