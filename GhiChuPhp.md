- Trong chuỗi string "", có 1 số kí tự đặc biệt đại diện cho những nội dung đặc biệt như xuống dòng, chèn code PHP trong chuỗi,... Khi xuất ra chuỗi string, các kí tự đặc biệt này sẽ không xuất hiện và tại vị trí của các kí tự đặc biệt này sẽ là nội dung mà nó đại diện.
- Trong chuỗi string "", "\kí tự đặc biệt" thì khi xuất ra chuỗi string sẽ hiển thị "\kí tự đặc biệt" . Nếu sử dụng "\\kí tự đặc biệt" thì khi xuất chuỗi string chỉ hiển thị kí tự \.
- Hàm asset() gọi đến thư mục public
- Cú pháp artisan run file seeder tự tạo: php artisan db:seed --class=`tên đầy đủ của class seeder`
- Trong các route module, nên khai báo sử dụng middleware web để các route module có đầy đủ tính năng như route mặc định. Ví dụ, phải có middleware web thì @error mới hoạt động
- Truy cập vào thành phần từ 1 thành phần cấp cao hơn nó 1 bậc có thể dùng dấu .