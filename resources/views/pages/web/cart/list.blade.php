
    <div class="row mb-3" id="cart">
        <div class="col-xl-8">
            <div class="row align-items-center gy-3 mb-3">
                <div class="col-sm">
                    <div>
                        <h5 class="fs-14 mb-0">Your Cart ({{ $count }} items)</h5>
                    </div>
                </div>
            </div>
            @foreach ($carts as $item)
            <input type="hidden" name="cart[]" value="{{ $item->id }}" />
            <div class="card data-product" data-size="{{$item->size->count}}" data-price="{{ $item->menu->price }}" data-quantity="{{ $item->quantity }}">
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-sm-auto">
                            <div class="avatar-lg bg-light rounded p-1 " style="width: 13rem; height:10rem;">
                                <img src="{{ asset('images/img/'.$item->menu->image) }}" style="width: 100%; height:100%;" alt=""
                                    class="img-fluid d-block">
                            </div>
                        </div>
                        <div class="col-sm">
                            <h5 class="fs-14 text-truncate"><a href="ecommerce-product-detail.html"
                                    class="text-dark">{{ $item->menu->nama }}</a></h5>
                            <ul class="list-inline text-muted">

                            </ul>

                            <div class="input-step">
                                <button type="button"
                                    onclick="update_quantity('{{  route('web.cart.decrease', $item->id) }}')"
                                    class="minus">–</button>
                                <input type="number" id="qty" class="product-quantity"
                                    value="{{ number_format($item->quantity) }}"
                                    onkeyup="input_quantity('{{ route('web.cart.update', $item->id) }}')" min="0"
                                    max="100" data-quantity="{{ $item->quantity }}">
                                <button type="button"
                                    onclick="update_quantity('{{  route('web.cart.increase', $item->id) }}')"
                                    class="plus">+</button>
                            </div>                           
                        </div>
                        <div class="col-sm-auto">
                            <div class="text-lg-end">
                                <p class="text-muted mb-1">Item Price:</p>
                                <h5 class="fs-14"><span id="ticket_price" data-price="{{ $item->menu->price }}"
                                        class="product-price">Rp. {{ number_format($item->menu->price,2,',', '.') }}</span></h5>
                            </div>
                            <div class="text-lg-end">
                                <p class="text-muted mb-1">Item Size:</p>
                                <h5 class="fs-14"><span id="ticket_price" data-price="{{ $item->size->count }}"
                                        class="product-price">{{ $item->size->size }}</span></h5>
                            </div>
                            <div class="text-lg-end">
                                <p class="text-muted mb-1">Item Price with size:</p>
                                <h5 class="fs-14"><span id="ticket_price" 
                                        class="product-price">Rp. {{ number_format($item->menu->price + (($item->menu->price * $item->size->count /100)),2,',', '.') }}</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card body -->
                <div class="card-footer">
                    <div class="row align-items-center gy-3">
                        <div class="col-sm">
                            <div class="d-flex flex-wrap my-n1">
                                <div>
                                    <a href="javascript:;"
                                        onclick="hapus_cart('Apakah Anda Yakin?','Yakin','Tidak','DELETE','{{route('web.cart.delete',$item->id)}}');"
                                        class="d-block text-body p-1 px-2"><i
                                            class="ri-delete-bin-fill text-muted align-bottom me-1"></i>
                                        Remove</a>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <div class="d-flex align-items-center gap-2 text-muted">
                                <div>Total :</div>
                                <h5 class="fs-14 mb-0 total-product-price"><span class="product-line-price"
                                        data-subtotal=""></span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card footer -->
            </div>
            <!-- end card -->
            @endforeach
            @if($count > 0)
            {{-- <div class="text-end mb-4">
                <input type="hidden" name="coupon_id">
                <form action="{{ route('web.checkout.index') }}" method="GET">
                    @csrf
                    <button href="javascript:;" class="btn btn-success btn-label right ms-auto"><i
                            class="ri-arrow-right-line label-icon align-bottom fs-16 ms-2"></i> Checkout</button>
                </form>
            </div> --}}
            <div class="text-end mb-4">
                <a href="{{ route('web.checkout.index') }}" class="btn btn-success btn-label right ms-auto"><i
                        class="ri-arrow-right-line label-icon align-bottom fs-16 ms-2"></i> Checkout</a>
            </div>
            @endif

        </div>
        <div class="col-xl-4">
            <div class="sticky-side-div">
                <div class="card">
                    <div class="card-header border-bottom-dashed">
                        <h5 class="card-title mb-0">Order Summary</h5>
                    </div>
                    {{-- <div class="card-header bg-soft-light border-bottom-dashed">
                        <div class="text-center">
                            <h6 class="mb-2">Memiliki <span class="fw-semibold"></span> Kupon ?</h6>
                        </div>
                        <div class="hstack gap-3 px-3 mx-n3">
                            <input class="form-control me-auto" name="coupon" type="text"
                                placeholder="Kode Kupon" aria-label="Add Promo Code here...">
                            <a type="button" onclick="kupon()" class="btn btn-success w-xs">Apply</a>
                        </div>
                    </div> --}}
                    <div class="card-body pt-2">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    {{-- <tr>
                                        <td>Sub Total :</td>
                                        <td class="text-end text-nowrap" id="cart-subtotal"></td>
                                    </tr>
                                    <tr>
                                        <td>Discount <span class="text-muted"></span> : </td>
                                        <td class="text-end discount text-nowrap" id="cart-discount">-Rp.0</td>
                                    </tr>                                     --}}
                                    <tr class="table-active">
                                        <th>Total (IDR) :</th>
                                        <td class="text-end">
                                            <span class="fw-semibold total" id="cart-total">                                            
                                                
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>

                
            </div>
        </div>
    </div>
<script>
    $(document).ready(function () {
        $('#checkout').hide();
        get_cart();

    });
    
    
    
    function update_quantity(url) {
        $.ajax({
            url: url,
            type: 'PATCH',
            success: function (data) {
                if(data.alert == 'success'){
                    success_toastr(data.message);
                    $('.total-product-price').html(data.subtotal);
                    $('.data-product').attr('data-quantity', data.quantity);
                    load_list(1);
                }else{
                    error_toastr(data.message);
                    $('.total-product-price').html(data.subtotal);
                    $('.data-product').attr('data-quantity', data.quantity);
                    load_list(1);
                }
            }
        });
    }

    function input_quantity(url) {
        let data = "quantity=" + $('#qty').val();
        $.ajax({
            url: url,
            type: 'PATCH',
            data: data,
            success: function (data) {
                $('.total-product-price').html(data.subtotal);
                $('#qty').val(data.quantity);
                load_list(1);
            }
        });

    }

    function get_cart() {
        $('.data-product').each(function () {
            var price = $(this).data('price');
            var quantity = $(this).data('quantity');
            var size = $(this).data('size')/100;
            var price = price + (price*size);
            var total = price * quantity ;            
            // $(this).find('.total-product-price').html('Rp.' + total.toFixed(2));
            $(this).find('.total-product-price').html(total.toLocaleString('id-ID',{style: 'currency', currency: 'IDR'}));
            $(this).find('.total-product-price').data('subtotal', total);
        });
        var subtotal_price = 0;
        $('.total-product-price').each(function () {
            subtotal_price += $(this).data('subtotal');
        });
        var total_price = subtotal_price - 0;
        $('#cart-subtotal').html(subtotal_price.toLocaleString('id-ID',{style: 'currency', currency: 'IDR'}));
        $('#cart-total').html(total_price.toLocaleString('id-ID',{style: 'currency', currency: 'IDR'}));
    }

    function hapus_cart(title, confirm_title, deny_title, method, route) {
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
                    beforeSend: function () {

                    },
                    success: function (response) {
                        if (response.alert == "success") {
                            success_toastr(response.message);
                            $('.top-cart-number').html(response.total_item ?? 0);
                            load_list(1);
                        } else {
                            error_toastr(response.message);
                        }
                    },
                });
            }
        });
    }
</script>