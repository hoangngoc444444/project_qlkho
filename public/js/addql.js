$(document).ready(function() {
    $("#qlForm").validate({
        rules: {
            name: {
                required: true,
                maxlength: 10
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            name: {
                required: "Tên không được để trống",
                maxlength: "Tên quản lý không dài quá 10 ký tự",
            },
            email: {
                required: "Email không được để trống",
                email: "Định dạng email không chính xác"
            }
        }
    })
});