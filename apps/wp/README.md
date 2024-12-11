# lệnh update cho git subtrees
git subtree push --prefix=wp-content/plugins/masterstudy-lms-learning-management-system https://github.com/GNH-Team/MasterStudy.git main
git subtree push --prefix=wp-content/plugins/masterstudy-lms-learning-management-system-pro https://github.com/GNH-Team/MasterStudy-Pro.git main

# 2 lệnh để tạo một subtrees mới
git subtree split --prefix=wp-content/plugins/masterstudy-lms-learning-management-system-pro -b MasterStudyPro
git push https://github.com/GNH-Team/MasterStudy-Pro.git MasterStudyPro:main


# Một Số Lệnh Git Subtree Cơ Bản
# Thêm Subtree:
git subtree add --prefix=libs/sub-repo https://github.com/nguoi-dung/sub-repo.git main --squash

# Pull Thay Đổi Từ Subtree:
git subtree pull --prefix=libs/sub-repo https://github.com/nguoi-dung/sub-repo.git main --squash

# Push Thay Đổi Về Subtree:
git subtree push --prefix=libs/sub-repo https://github.com/nguoi-dung/sub-repo.git main

# Tách Subtree Thành Repository Riêng:
git subtree split --prefix=libs/sub-repo -b subrepo-branch
git push https://github.com/nguoi-dung/new-sub-repo.git subrepo-branch:main
