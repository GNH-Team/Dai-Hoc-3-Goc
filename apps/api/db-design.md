# User
{
    id: 1
    email: abc@x.com
}

# Group
{
    id: 1
    course_id; 1
    name: Xin chao
    slogan: the gioi
    cover: cover.jpeg
    avatar: avatar.png
    created_by: 3
    created_at: 123
}

# Group_member
{
    id: 1
    group_id: 2
    user_id: 3
    role: "TRUONGTHON" // PHOTHON, THANHVIEN
    order: 1
    added_by: 3 // user_id, tạo 1 user là robot sử dụng cho các hoạt động tự động hoá như auto thêm học viên vào group lớp
}

# Điểm Danh
{
    id: 1
    user_id: 2
    lesson_id: 3
    form_submit_id: 1
    created_at: 333
}

# Form_submit
{
    id: 1
    form_id: 2
    data: {

    }
}

# FeedType
{
    id: REN_THAN
    name: Rèn Thân
    description: Thân khoẻ - Tâm An
    color: #fff
    background: #eee
    icon: chaybo.png
    cover: cover.png
}

# Newfeed
{
    id: 1
    user_id: 2
    feed_type: REN_THAN

}
