$(document).ready(function() {
    $("#add").click(function() {
        var lastField = $("#buildyourform div:last");
        var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
        var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
        fieldWrapper.data("idx", intId);
        var fName = $("<input type=\"text\" class=\"fieldname\" name=\"productname[]\" placeholder=\"Tên Sản phẩm\" />");
        var fqty = $("<input type=\"number\" class=\"fieldname\" name=\"quantity[]\" placeholder=\"Số lượng\" />");
        var removeButton = $("<input type=\"button\" class=\"remove\" value=\"X\" />");
        removeButton.click(function() {
            $(this).parent().remove();
        });
        fieldWrapper.append(fName);
        fieldWrapper.append(fqty);
        fieldWrapper.append(removeButton);
        $("#buildyourform").append(fieldWrapper);
    });
});
