jQuery(function($){
    function get_table() {
        $.ajax({
            type : "post",
            url : my_script_object.ajax_url,
            dataType: "json",
            cache: true,
            data : {action: "get_table"},
            success: function(response) {
                $('#frmchal-list').html(response.table);
                $('#count').html(response.items_qty);
                $('#current_date').html(response.current_date);
            },
            error: function(response) {
                console.error('An error has ocurred, please try again.');
            }
        });
    }
    $(document).ready( function () {
        get_table();
        $('#refresh').on("click", function() {
            get_table();
        });
    });
});
