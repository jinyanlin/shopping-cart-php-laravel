// delete-product
$(document).ready(function(){
    loadnewOrder();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadnewOrder(){
        $.ajax({
            method: "GET",
            url: "/load-neworder-data",
            success: function (response){
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
            }
        });
    }

    $('.delete-product').click(function(e){
        e.preventDefault();

        var prod_id = $(this).closest('.product_admindata').find('.prod_id').val();
        console.log(prod_id);
        // $.ajax({
        //     method: "POST",
        //     url: "delete-admin-product",
        //     data: {
        //         'id':prod_id,
        //     },
        //     success: function(response){
        //         //window.location.reload();
        //         swal("",response.status,"success");
        //     }
        // });
    })
})