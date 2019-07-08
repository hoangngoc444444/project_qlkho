$(document).ready(function() {
    $("#xuatnhapForm").validate({
        rules: {
            name: {
                required: true,
                maxlength: 10
            },
            type: {
                required: true,
            },
            productname: {
                required: true,
            },
            quantity: {
                required: true,
                number: true
            }
        },
        messages: {
            name: {
                required: "Tên phiếu không được để trống",
                maxlength: "Tên phiếu không dài quá 10 ký tự",
            },
            type: {
                required: "Chọn loại xuất hay nhập kho",
            },
            productname: {
                required: "Nhập tên sản phẩm vào",
            },
            quantity: {
                required: "Nhập số lượng sản phẩm vào",
                number: "Số lượng phải là 1 số",
            }
        }
    })
});