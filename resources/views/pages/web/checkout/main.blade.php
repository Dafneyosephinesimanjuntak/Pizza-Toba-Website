<x-app-layout title="Checkout">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Checkout</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <form id="form_checkout" action="{{ route('web.checkout') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body checkout-tab">
                        <div class="step-arrow-nav mt-n3 mx-n3 mb-3">

                            <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3 active" id="pills-bill-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab"
                                        aria-controls="pills-bill-info" aria-selected="true"><i
                                            class="ri-user-2-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                        Personal Info</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3" id="pills-bill-address-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-bill-address" type="button" role="tab"
                                        aria-controls="pills-bill-address" aria-selected="false"><i
                                            class="ri-wallet-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                        Payment Method</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3" id="pills-payment-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-payment" type="button" role="tab"
                                        aria-controls="pills-payment" aria-selected="false"><i
                                            class="ri-bank-card-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                        Payment Info</button>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel"
                                aria-labelledby="pills-bill-info-tab">
                                <div>
                                    <h5 class="mb-1">Billing Information</h5>
                                    <p class="text-muted mb-4">Please fill all information below</p>
                                </div>

                                <div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="fullname" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="fullname" name="fullname"
                                                    placeholder="Enter first name"
                                                    value="{{ Auth::guard('web')->user()->fullname }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Enter email"
                                                    value="{{ Auth::guard('web')->user()->email }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Nomor Telepon</label>
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                    placeholder="Enter phone"
                                                    value="{{ Auth::guard('web')->user()->phone }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label">Address</label>
                                        <textarea class="form-control" id="" name="address" placeholder="Enter address"
                                            rows="3">{{ Auth::guard('web')->user()->address }}</textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="province" class="form-label">Provinsi</label>
                                                <select class="form-control" id="province" name="province"
                                                    data-plugin="choices">
                                                    <option value="">Select Province</option>
                                                    @foreach($provinces as $province)
                                                    <option value="{{ $province->id }}" {{ Auth::guard('web')->user()->province_id==$province->id?'selected':''}}>{{ $province->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="city" class="form-label">Kota</label>
                                                <select class="form-control" id="city" name="city">
                                                    @if(Auth::guard('web')->user()->city_id == null)
                                                    <option value="">Select Kota</option>
                                                    @else
                                                    @foreach($cities as $city)
                                                    <option value="{{ $city->id }}" {{ Auth::guard('web')->user()->city_id==$city->id?'selected':''}}>{{ $city->name }}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="district" class="form-label">Kecamatan</label>
                                                <select class="form-control" id="subdistrict" name="subdistrict">
                                                    @if(Auth::guard('web')->user()->subdistrict_id == null)
                                                    <option value="">Select Kecamatan</option>
                                                    @else
                                                    @foreach($subdistricts as $subdistrict)
                                                    <option value="{{ $subdistrict->id }}" {{ Auth::guard('web')->user()->subdistrict_id==$subdistrict->id?'selected':''}}>{{ $subdistrict->name }}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="postal_code" class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" id="postal_code" name="postal_code"
                                            placeholder="Enter postal code"
                                            value="{{ Auth::guard('web')->user()->postal_code }}">
                                    </div>
                                    <input type="hidden" name="coupon_id" value="">

                                    <div class="d-flex align-items-start gap-3 mt-3">
                                        <button type="button" class="btn btn-primary btn-label right ms-auto nexttab"
                                            data-nexttab="pills-bill-address-tab"><i
                                                class="ri-bank-card-line label-icon align-middle fs-16 ms-2"></i>Continue
                                            to Payment</button>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-bill-address" role="tabpanel"
                                aria-labelledby="pills-bill-address-tab">
                                                <div>
                                                    <h5 class="mb-1">Payment Selection</h5>
                                                    <p class="text-muted mb-4">Please select and enter your billing
                                                        information</p>
                                                </div>

                                                <div class="row g-4 justify-content-evenly">
                                                    <div class="col-lg-6 col-sm-6" >
                                                        <div data-bs-toggle="collapse"
                                                            data-bs-target="#paymentmethodCollapse" aria-expanded="true"
                                                            aria-controls="paymentmethodCollapse">
                                                            <div class="form-check card-radio">
                                                                <input id="shippingMethod02" name="payment" type="radio"
                                                                    value="Bank Transfer" class="form-check-input" checked>
                                                                <label class="form-check-label" for="shippingMethod02">
                                                                    <span class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">Bank</span>
                                                                    <span class="fs-14 mb-1 text-wrap d-block jus">Mandiri</span>
                                                                    <span class="text-muted fw-normal text-nowrap d-block">Rek. 1560009861578</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6">
                                                        <div data-bs-toggle="collapse"
                                                            data-bs-target="#paymentmethodCollapse.show"
                                                            aria-expanded="false" aria-controls="paymentmethodCollapse">
                                                            <div class="form-check card-radio">
                                                                <input id="shippingMethod01" name="payment" type="radio"
                                                                    value="Cash" class="form-check-input">
                                                                <label class="form-check-label" for="shippingMethod01">
                                                                    <span class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">Cash/Tunai</span>
                                                                    <span class="fs-14 mb-1 text-wrap d-block">Cash</span>
                                                                    <span class="text-muted fw-normal text-wrap d-block">Bayar ke Kasir</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-sm-6">
                                                        <div data-bs-toggle="collapse"
                                                            data-bs-target="#paymentmethodCollapse.show"
                                                            aria-expanded="false" aria-controls="paymentmethodCollapse">
                                                            <div class="form-check card-radio">
                                                                <input id="shippingMethod03" name="payment" type="radio"
                                                                    value="E-money" class="form-check-input">
                                                                <label class="form-check-label" for="shippingMethod03">
                                                                    <span class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">E-Money</span>
                                                                    <span class="fs-14 mb-1 text-wrap d-block">Dana</span>
                                                                    <span class="text-muted fw-normal text-wrap d-block">089688875900</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="collapse show" id="paymentmethodCollapse">
                                                    <div class="card p-4 border shadow-none mb-0 mt-4">
                                                        <div class="row gy-3">
                                                            <div class="col-md-12">
                                                                <label for="cc-name" class="form-label">Name on
                                                                    card</label>
                                                                <input type="text" name="card_name" class="form-control" id="cc-name"
                                                                    placeholder="Enter name" value="{{ Auth::user()->card_name }}">
                                                                <small class="text-muted">Full name as displayed on
                                                                    card</small>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label for="cc-number" class="form-label">Credit card
                                                                number</label>
                                                                <input type="text" name="card_id" class="form-control" id="cc-number"
                                                                    placeholder="xxxx xxxx xxxx xxxx" value="{{ Auth::user()->card_id }}">
                                                            </div>

                                                            
                                                        </div>
                                                    </div>                                                    
                                                </div>

                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button type="button" class="btn btn-light btn-label previestab"
                                                        data-previous="pills-bill-info"><i
                                                            class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Back
                                                        to Shipping</button>
                                                    <a href="javascript:;" onclick="payment()"
                                                        class="btn btn-primary btn-label right ms-auto nexttab"
                                                        data-nexttab="pills-payment-tab"><i
                                                            class="ri-shopping-basket-line label-icon align-middle fs-16 ms-2"></i>Complete
                                                        Order</a>
                                                </div>
                                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="pills-payment" role="tabpanel"
                                aria-labelledby="pills-payment-tab">
                                <div id="bukti">
                                    <div>
                                        <h5 class="mb-1">Bukti Pembayaran</h5>
                                        <p class="text-muted mb-4">Please select and enter your billing
                                            information</p>
                                    </div>

                                    <div class="card p-4 border shadow-none mb-0 mt-4">
                                        <div class="row gy-3">
                                            <div class="col-md-12">
                                                <label for="image" class="form-label">Bukti Pembayaran</label>
                                                <input type="file" class="form-control" id="image" name="image">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-light btn-label previestab"
                                        data-previous="pills-bill-address-tab"><i
                                            class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Back
                                        to Payment Method</button>
                                    <a href="javascript:;" onclick="checkout('#form_checkout', 'POST')"
                                        class="btn btn-primary btn-label right ms-auto nexttab"
                                        data-nexttab="pills-finish-tab"><i
                                            class="ri-shopping-basket-line label-icon align-middle fs-16 ms-2"></i>Complete
                                        Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-0">Order Summary</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-header bg-soft-light border-bottom-dashed">
                        <div class="text-center">
                            <h6 class="mb-2">Memiliki <span class="fw-semibold"></span> Kupon ?</h6>
                        </div>
                        <div class="hstack gap-3 px-3 mx-n3">
                            <input class="form-control me-auto" name="coupon" type="text"
                                placeholder="Kode Kupon" aria-label="Add Promo Code here...">
                            <a type="button" onclick="kupon()" class="btn btn-success w-xs">Apply</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless align-middle mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th style="width: 90px;" scope="col">Product</th>
                                        <th scope="col" class="text-nowrap">Product Info</th>
                                        <th scope="col" class="">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $item)
                                    @php
                                    $totals = $item->menu->price + ($item->size->count * $item->menu->price /100 );
                                    $total = 0;                                    
                                    $total += $totals * $item->quantity;
                                    @endphp
                                    <tr class="data-product" data-size="{{$item->size->count}}" data-price="{{ $item->menu->price }}" data-quantity="{{ $item->quantity }}">
                                        <td>
                                            <div class="avatar-md bg-light rounded p-1">
                                                <img src="{{ asset('images/img/'.$item->menu->image) }}" style="height: 100%; width:100%;" alt=""
                                                    class="img-fluid d-block mx-auto ">
                                            </div>
                                        </td>
                                        <td class="">                                            
                                            <span class="fw-semibold">
                                                {{$item->menu->nama}}
                                            </span><br>
                                            <small class="text-muted text-nowrap fs-10" data-size="{{$item->size->count}}">Rp.{{ number_format($item->menu->price + (($item->menu->price * $item->size->count /100)),2,'.', ',') }} X <span data-quantity="{{$item->quantity}}">{{$item->quantity}}</span></small>
                                        </td>
                                        <td class="text-nowrap">
                                            <span class="fw-semibold price" data-price="{{($item->menu->price + ($item->menu->price * $item->size->count /100)) * $item->quantity }}">Rp. {{ number_format(($item->menu->price + ($item->menu->price * $item->size->count /100)) * $item->quantity,2,',','.') }}
                                                </span>
                                        </td>
                                    </tr>
                                    
                                    @endforeach
                                    <tr>
                                        <td >Sub Total :</td>
                                        <td colspan="2" class="text-end text-nowrap" id="cart-subtotal"></td>
                                    </tr>
                                    <tr>
                                        <td >Discount <span class="text-muted"></span> : </td>
                                        <td colspan="2" class="text-end discount text-nowrap" id="cart-discount" data-discount="">-Rp.0</td>
                                    </tr>
                                    <tr class="table-active">
                                    <th  class="pb-3">Total (IDR) :</th>
                                        <td colspan="2" class="text-nowrap pb-3 text-end">
                                            <span class="fw-semibold cart-total" id="all-total"></span>
                                        </td><br>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- end row -->
    </form>
    @section('custom_js')
    <script>
        $(document).ready(function () {
            $('.nexttab').click(function () {
                var nexttab = $(this).data('nexttab');
                $('#' + nexttab).click();
            });
            
            $('.previestab').click(function () {
                var previestab = $(this).data('previous');
                $('#' + previestab).click();
            });
            var subtotal = 0;
            $('.price').each(function(){
                subtotal = subtotal + $(this).data('price')   
            });
            $('#cart-subtotal').html(subtotal.toLocaleString('id-ID',{style: 'currency', currency: 'IDR'})); 
            
            var total_price = subtotal - 0;
            $('#all-total').html(total_price.toLocaleString('id-ID',{style: 'currency', currency: 'IDR'}));
            
            // get_cart();                        
        });

        
        function payment(){
            var payment = $('input[name="payment"]:checked').val();
            console.log(payment);
            if (payment == 'Cash'){
                $('#bukti').hide();
            }else{
                $('#bukti').show();
            }

        }

        function checkout(form, method) {
            let formData = new FormData($(form)[0]);
            $.ajax({
                url: "{{ route('web.check') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if (response.alert == 'error') {
                        Swal.fire({
                            text: response.message,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, Mengerti!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                        setTimeout(function () {
                            $(tombol).prop("disabled", false);
                            $(tombol).removeAttr("data-kt-indicator");
                        }, 2000);
                    } else {
                        $('#form_checkout').submit();
                    }
                }
            });
        }
        

        $("#province").change(function () {
            $.post('{{route('web.regional.city')}}', {
                    province: $("#province").val()
                },
                function (result) {
                    $("#city").html(result);
                }, "html");
        });
        $("#city").change(function () {
            $.post('{{route('web.regional.subdistrict')}}', {
                    city: $("#city").val()
                },
                function (result) {
                    $("#subdistrict").html(result);
                }, "html");
        });
        
        function kupon(tombol) {
            var coupon = $('input[name="coupon"]').val();
            $(tombol).prop("disabled", true);
            $(tombol).html("Please wait");
            $.ajax({
                url: "{{ route('web.checkout.coupon') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    coupon: coupon                    
                },
                success: function(response, title) {
                    if (response.alert == 'success') {
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, Mengerti!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                        setTimeout(function() {
                            $(tombol).prop("disabled", false);
                            $(tombol).html(title);                                                        
                        }, 2000);
                        $('.discount').html('Discount <span class="text-success">(' + response.discount +
                            '% Off!)</span> </br> <span class="float-right text-4 font-weight-500 text-dark"> - Rp. ' +
                            format_ribuan(response.total_discount.toLocaleString('id-ID',{style: 'currency', currency: 'IDR'})) + '</span>');
                        // $('.total').html('Rp. ' + format_ribuan(response.total));      
                        $('#all-total').html(format_ribuan(response.total.toLocaleString('id-ID',{style: 'currency', currency: 'IDR'})));
                        $('input[name="coupon_id"]').val(response.coupon);
                    } else {
                        Swal.fire({
                            text: response.message,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, Mengerti!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                        setTimeout(function() {
                            $(tombol).prop("disabled", false);
                            $(tombol).html('APPLY');
                        }, 2000);
                    }
                }
            });
        }
    </script>
    @endsection
</x-app-layout>