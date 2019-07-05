$(document).ready(function() {
    $("#khoForm").validate({
        rules: {
            name: {
                required: true,
                maxlength: 10
            },
            user_id: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Tên kho không được để trống",
                maxlength: "Tên kho không dài quá 10 ký tự",
            },
            user_id: {
                required: "Chọn người quản lý kho",
            }
        }
    })
});