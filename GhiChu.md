# Dự án Website học trực tuyến

## Dành cho người dùng
- Hiển thị danh sách khóa học
- Hiển thị thông tin chi tiết khóa học
- Xem video bài giảng
- Download tài liệu bài giảng
- Học thử bài giảng
- Đăng ký/Đăng nhập
- Trang tài khoản: Thông tin cá nhân, danh sách khóa học của tôi,...
- Mua khóa học
- Hiển thị danh sách tin tức
- Hiển thị chi tiết tin tức

## Dành cho quản trị
- Quản lý danh mục
- Quản lý học viên
- Quản lý khóa học
- Quản lý giảng viên
- Quản lý bài giảng
- Quản lý danh mục tin tức
- Quản lý tin tức
- Kích hoạt khóa học cho học viên
- Quản lý file tài liệu
- Quản lý video
- Quản lý đơn hàng
- Quản lý người dùng (Quản lý hệ thống)
- Phân quyền quản trị hệ thống
- Báo cáo, thống kê,...

## API:
- Xây dựng API hoàn chỉnh

## Phân tích Database:
(phân tích các Table từ phần quản trị)

1. Table categories => Quản lý danh mục
- id => int
- name => varchar(200)
- slug => varchar(200)
- parent_id => int
- created_at => timestamp
- updated_at => timestamp

2. Table course => Quản lý khóa học
- id => int
- name => varchar(255)
- slug => varchar(255)
- detail => text
- teacher_id => int (forein key -> table Teacher)
- thumbnail => varchar(255)
- price => float
- sale_priece => float
- code => varchar(100)
- durations => float
- is_document => tinyint
- supports => text
- status => tinyint
- created_at => timestamp
- updated_at => timestamp

3. Table lession => Quản lý bài giảng
- id => int
- name => varchar(255)
- slug => varchar(255)
- video_id => int
- document_id => int
- parent_id => int
- is_trial => tinyint
- views => int
- position => int
- duration => float
- description => text
- created_at => timestamp
- updated_at => timestamp

4. Table categories_courses => Trung gian liên kết giữa danh mục và khóa học
- id => int
- category_id => int
- course_id => int
- created_at => timestamp
- updated_at => timestamp

5. Table teacher => Giảng viên
- id => int
- name => varchar(100)
- slug => varchar(100)
- description => text
- exp => float
- image => varchar(255)
- created_at => timestamp
- updated_at => timestamp

6. Table videos => Quản lý video bài giảng
- id => int
- name => varchar(255)
- url => varchar(255)
- created_at => timestamp
- updated_at => timestamp

7. Table documents => Quản lý tài liệu bài giảng
- id => int
- name => varchar(255)
- url => varchar(255)
- size => float
- created_at => timestamp
- updated_at => timestamp

8. Table categories_posts => Quản lý danh mục tin tức
- id => int
- name => varchar(200)
- slug => varchar(200)
- parent_id => int
- created_at => timestamp
- updated_at => timestamp

9. Table posts => Quản lý tin tức
- id => int
- title => varchar(255)
- slug => varchar(255)
- content => text
- excerpt => text
- thumbnail => varchar(255)
- category_id => int (foreign key to categories_posts)
- created_at => timestamp
- updated_at => timestamp

10. Table students => Quản lý học viên
- id => int
- name => varchar (100)
- email => varchar(100)
- phone => varchar(20)
- password => varchar(100)
- address => varchar(200)
- status => tinyint(1)
- created_at => timestamp
- updated_at => timestamp

11. Table students_courses => Trung gian học viên và khóa học 
- id => int
- course_id => int
- student_id => int
- created_at => timestamp
- updated_at => timestamp

12. Table orders => Quản lý đơn đăng ký của học viên
- id => int
- student_id => int
- total => float
- status => tinyint(1)
- created_at => timestamp
- updated_at => timestamp

13. Table orders_details => Chi tiết đơn hàng
- id -> int
- order_id => int
- course_id => int
- price => float
- created_at => timestamp
- updated_at => timestamp

14. Table orders_status => Quản lý trạng thái đơn hàng
- id => int
- name => varchar(200)
- created_at => timestamp
- updated_at => timestamp

15. Table users => Quản trị hệ thống
- id => int
- name => varchar(100)
- password => varchar(100)
- group_id => int
- created_at => timestamp
- updated_at => timestamp

16. Table groups => Quản trị nhóm người dùng
- id => int
- name => varchar(100)
- permissions => text
- created_at => timestamp
- updated_at => timestamp

17. Table module => Danh sách các module trong trang quản trị
- id => int
- name => varchar(100)
- title => varchar(200)
- role => text

18. Table options => Quản lý các thiết lập
- id => int
- name => varchar(100)
- value => text

## Cài đặt Laravel Module và Repository

### Cài đặt Laravel Module

### Cài đặt Repository cho Laravel Module

## Viết Artisan Console cho Laravel Module

`php artisan make:module ten_module`

## Tích hợp Layout Admin

## Xây dựng Module quản lý Users

### Tạo migrations - Seeder - Chuân bị giao diện

### Tạp Repository và các phương thức cần thiết
- Hiển thị danh sách User (Có phân trang)
- Thêm user
- Sửa user
- Xóa user
- Lấy thông tin 1 user

### Tạo FormRequest và các phương thức Validation

### Viết chức năng thêm user

### Viết chức năng hiển thị user

Thư viện datatable: https://datatables.net/

Package hỗ trợ datatable của Laravel: https://yajrabox.com/docs/laravel-datatables/10.0

Thư viện faker factory: https://github.com/fzaninotto/Faker

Kiểm tra câu lệnh SQL: https://github.com/barryvdh/laravel-debugbar