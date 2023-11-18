/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => { //khi load xong các DOM thì thực hiện lắng nghe và xử lý các sự kiện

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
    const deleteForm = document.querySelector('.delete-form');
    if (tableList)
    {
        tableList.addEventListener('click', (e) => {
            if (e.target.classList.contains('delete-action')) //target trả về phần tử (thẻ) HTML theo dạng đối tượng (DOM) mà người dùng thao tác vào
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
    }
    
    const getSlug = (title) => {
        //Đổi chữ hoa thành chữ thường
        let slug = title.toLowerCase();
        console.log(slug);
    
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, "a");
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, "e");
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, "i");
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, "o");
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, "u");
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, "y");
        slug = slug.replace(/đ/gi, "d");
        //Xóa các ký tự đặt biệt
        slug = slug.replace(
            /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi,
            ""
        );
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, "-");
        slug = slug.replace(/\-\-\-\-/gi, "-");
        slug = slug.replace(/\-\-\-/gi, "-");
        slug = slug.replace(/\-\-/gi, "-");
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = "@" + slug + "@";
        slug = slug.replace(/\@\-|\-\@|\@/gi, "");
        console.log(slug);
        return slug;
    }

    let title = document.querySelector('.title');
    let slug = document.querySelector('.slug');
    let isChangeSlug = false;

    if (slug.value === '')
    {
        title.addEventListener('keyup', (e) => { //key up là sự kiện nhả phím, key down là sự kiện nhấn phím
            if (!isChangeSlug)
            {
                let titleValue = e.target.value;
                slug.value = getSlug(titleValue);
            }
        });
    }
    
    slug.addEventListener('change', () => {
        if (slug.value === '')
        {
            let title = document.querySelector('.title');
            let titleValue = title.value;
            slug.value = getSlug(titleValue);
        }
        isChangeSlug = true;
    });
});

