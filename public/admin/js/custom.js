// delete-product
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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