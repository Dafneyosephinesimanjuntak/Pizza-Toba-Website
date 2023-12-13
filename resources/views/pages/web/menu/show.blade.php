<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row gx-lg-5">
                    <div class="col-xl-4 col-md-8 mx-auto">
                        <div class="product-img-slider sticky-side-div">
                            <div
                                class="swiper product-thumbnail-slider p-2 rounded bg-light swiper-initialized swiper-horizontal swiper-pointer-events">
                                <div class="swiper-wrapper" id="swiper-wrapper-3d89eb772a51055d" aria-live="polite"
                                    style="transform: translate3d(0px, 0px, 0px);">
                                    <div class="swiper-slide swiper-slide-active mx-auto" role="group" aria-label="1 / 4" style="width: 218px; ">
                                        <img src="{{  asset('images/img/'.$menu->image) }}" alt="" class="img-fluid d-block" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="mt-xl-0 mt-5">
                            <div class="row mt-4">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="p-2 border border-dashed rounded">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <div class="avatar-title rounded bg-transparent text-info fs-24">
                                                    <i class="ri-money-dollar-circle-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="text-muted mb-1">Price :</p>
                                                <h5 class="mb-0">{{ $menu->price }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="p-2 border border-dashed rounded">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <div class="avatar-title rounded bg-transparent text-info fs-24">
                                                    @if($menu->category == 'Makanan')
                                                        <i class="ri-restaurant-fill"></i>
                                                    @else
                                                        <i class="ri-goblet-fill"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="text-muted mb-1">Available Stocks :</p>
                                                <h5 class="mb-0">{{ $menu->stock }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-muted">
                                <h5 class="fs-14">Description :</h5>
                                <p style="text-indent:30px; text-align:justify;">{{ $menu->description }}</p>
                            </div>
                            @auth
                            <form id="form_cart">
                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                <div class="row mt-4">
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="input-step">
                                            <button type="button" onclick="kurang()" class="minus">–</button>
                                            <input type="number" name="quantity" class="product-quantity" value="1" min="0" max="100">
                                            <button type="button" onclick="tambah()" class="plus">+</button>
                                        </div> 
                                        <div class="pt-3">
                                            <select class="form-select mb-3" name="size_id" aria-label="Default select example">
                                                <option disabled selected>Pilih Ukuran</option>
                                                @foreach($size as $size)
                                                    <option value="{{$size->id}}">{{$size->size}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="pt-5 col-lg-4 col-sm-4">
                                    </div>
                                    <div class="col-lg-4 col-sm-4 mt-5 d-md-flex justify-content-end" style="height: 20%">
                                        <button id="tombol_cart"
                                            onclick="add_cart('#tombol_cart', '#form_cart', '{{ route('web.cart.add') }}', 'POST')"
                                            class="btn btn-success waves-effect waves-light">Tambah Ke
                                            Keranjang</button>
                                    </div>
                                </div>
                            </form>
                            @endauth
                        
                    </div>
                    
                </div>
                <div class="hstack gap-2 justify-content-end">
                    <a class="btn btn-light" href="javascript:;" onclick="load_list(1);">Kembali</a>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
<script>
    function tambah() {
        var value = parseInt($('.product-quantity').val());
        $('.product-quantity').val(value + 1);
    }
    function kurang() {
        var value = parseInt($('.product-quantity').val());
        if (value > 1) {
            $('.product-quantity').val(value - 1);
        }
    }
</script>