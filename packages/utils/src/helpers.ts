export async function sleep(ms: number) {
    return new Promise<void>((resolve) => {
        setTimeout(resolve, ms)
    })
}

export function log(message?: any, ...optionalParams: any[]): void {
    console.log(message, ...optionalParams)
}

export function loadScript(src: string): Promise<void> {
    return new Promise((resolve, reject) => {
        const script = document.createElement("script")
        script.src = src
        script.type = "text/javascript"
        script.async = false
        script.defer = false
        script.onload = () => {
            resolve()
        }
        script.onerror = () => reject(new Error(`Failed to load script: ${src}`))
        document.head.appendChild(script)
    })
}

export function  randomString(length: number = 10): string{
    const randomChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"
    let result = ""
    for (let i = 0; i < length; i += 1) {
        result += randomChars.charAt(Math.floor(Math.random() * randomChars.length))
    }
    return result
}

// xoá dấu tiếng việt và các ngôn ngữ latin có dấu khác : https://www.tunglt.com/2018/11/bo-dau-tieng-viet-javascript-es6/
export function removeAccents(str: string): string {
    return str.normalize('NFD')
              .replace(/[\u0300-\u036f]/g, '')
              .replace(/đ/g, 'd').replace(/Đ/g, 'D');
  }


// Hàm tạo tổ hợp chập k của một mảng
export function getCombinations<T>(arr: T[], k: number): T[][] {
    const result: T[][] = []
    const combination: T[] = []

    function recurse(start: number) {
        if (combination.length === k) {
            result.push([...combination])
            return
        }
        for (let i = start; i < arr.length; i++) {
            const item = arr[i];
            if (item !== undefined) { // Kiểm tra xem item có phải là undefined không
                combination.push(item)
                recurse(i + 1)
                combination.pop()
            }
        }
    }

    recurse(0)
    return result
}

export function regexValidateUnicode(){
    return /^[a-zA-ZáàảãạăắặằẳẵâấầẩẫậđéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵÁÀẢÃẠĂẮẶẰẲẴÂẤẦẨẪẬĐÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰÝỲỶỸỴ\s]+$/
}