$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.edit').click(function() {
        $(this).addClass('editMode');
    });

    $(".edit").focusout(function() {
        $(this).removeClass("editMode");
        var id = this.id;
        var split_id = id.split("_");
        var field_name = split_id[0];
        var edit_id = split_id[1];
        var value = $(this).text();

        $.ajax({
            url: '/changeware',
            type: 'post',
            data: { field: field_name, value: value, id: edit_id },
            success: function(response) {
                console.log('success');
            }
        });

    });
});