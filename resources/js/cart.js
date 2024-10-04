(function ($) {
    $('.item-quantity').on('change', function (e) {
        $.ajax({
            url: "/cart/" + $(this).data('id'),
            method: 'put',
            data:
            {
                quantity: $(this).val(),
                token: csrf_token
            }
        })
    });


})(jquery);