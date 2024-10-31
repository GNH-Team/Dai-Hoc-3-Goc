const express = require("express")
const axios = require("axios")

const app = express()
const port = 3303

app.get("/pdf", async (req, res) => {
    try {
        const pdfUrl = "https://backend.gnhteam.com/assets/e4108cd4-6801-4505-acf1-b3457a788874?download="

        const response = await axios({
            method: "get",
            url: pdfUrl,
            responseType: "stream"
        })

        res.setHeader("Content-Type", "application/pdf")
        res.setHeader("Content-Disposition", "attachment; filename=\"downloaded-file.pdf\"")
        // res.setHeader("Transfer-Encoding", "chunked")

        // Nếu header Content-Length có sẵn
        if (response.headers["content-length"]) {
            console.log("Content-Length:", response.headers["content-length"])
            // res.setHeader("Content-Length", response.headers["content-length"])
        }

        response.data.pipe(res)

        response.data.on("error", (err) => {
            console.error("Lỗi trong quá trình truyền dữ liệu:", err)
            res.status(500).send("Lỗi khi truyền file PDF.")
        })
    } catch (error) {
        console.error("Lỗi khi thực hiện yêu cầu:", error)
        res.status(500).send("Lỗi máy chủ nội bộ.")
    }
})

app.listen(port, () => {
    console.log(`Server đang chạy trên cổng ${port}`)
})
