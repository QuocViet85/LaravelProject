/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    const tableList = document.querySelector("#datatable");
    const deleteForm = document.querySelector('.delete-form')
    tableList.addEventListener('click', (e) => {
        if (e.target.classList.contains('delete-action')) //target trả về phần tử (thẻ) HTML theo dạng đối tượng mà người dùng click vào
        {
            e.preventDefault(); //vô hiệu hóa ảnh hưởng của phần tử khi có thao tác với phần tử (ở đây là thao tác click)
            Swal.fire({
                title: "Bạn có chắc chắn xóa?",
                text: "Nếu xóa bạn không thể khôi phục!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ok, Đồng ý xóa!"
              }).then((result) => {
                if (result.isConfirmed) {
                    const action = e.target.href; //lấy link (giá trị thuộc tính href) của thẻ a
                    console.log(action);
                    deleteForm.action = action;
                    deleteForm.submit();
                }
              });
        }
    });
});

