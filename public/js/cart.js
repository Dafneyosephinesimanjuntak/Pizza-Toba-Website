load_cart(localStorage.getItem("route_cart"));
function tombol_cart(){
    load_cart(localStorage.getItem("route_cart"));
}
function load_cart(url){
    // let data = "view="+ view + "&load_keranjang=";
    $.ajax({
        type: "GET",
        url: url,
        dataType: 'json',
        success: function (response){
            $('.top-cart-items').html(response.collection);
            $('.top-checkout-price').html('Rp. '+format_ribuan(response.total));
            $('.top-cart-number').html(response.total_item ?? 0);
            // $('#counter_cart').html(format_ribuan(response.total_item) ?? 0);
        },
    });
}
function add_cart(tombol, form, url, method){
    $(tombol).submit(function() {
        return false;
    });
    let data = $(form).serialize();
    $(tombol).prop("disabled", true);
    $.ajax({
        type: method,
        url: url,
        data: data,
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(response) {
            if (response.alert == "success") {
                success_toastr(response.message);
                $(form)[0].reset();
                load_cart(localStorage.getItem("route_cart"));
            } else {
                error_toastr(response.message);
            }
            $(tombol).prop("disabled", false);
        },
    });
}
function remove_cart(title, confirm_title, deny_title, method, route){
    Swal.fire({
        title: title,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: confirm_title,
        denyButtonText: deny_title,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: method,
                url: route,
                dataType: 'json',
                beforeSend: function() {

                },
                success: function(response) {
                    if (response.alert == "success") {
                        success_toastr(response.message);
                        load_cart(localStorage.getItem("route_cart"));
                    } else {
                        error_toastr(response.message);
                    }
                },
            });
        }
    });
}
$(document).on('click', '#top-cart', function(){
    load_cart(localStorage.getItem("route_cart"));
});