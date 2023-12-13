<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Order Details</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                    <li class="breadcrumb-item active">Order Details</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h5 class="card-title flex-grow-1 mb-0">Order {{ $order->code }}</h5>
                    
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table align-middle table-borderless mb-0 text-center">
                        <thead class="table-light text-muted">
                            <tr>
                                <th scope="col" style="width:50px;">Product Details</th>
                                <th scope="col">Item Price</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th scope="col" class="">Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderDetails as $item)
                            <tr>
                                <td class="col-md-4">
                                    <div class="row justify-content-center">
                                        <div class=" flex-shrink-0 avatar-md bg-light rounded p-1 col-md-4" style="width:60%;height:60%;">
                                            <img src="{{ asset('images/img/'.$item->menu->image) }}" alt="" class="img-fluid d-block" style="height:100%; width:100%; ">
                                            <div class="flex-grow-1 text-wrap text-center mt-1 ">
                                                <h5 class="col fs-15 link-primary fs-6 text-center">{{ $item->menu->nama }}</h5>
                                            </div>
                                        </div>                                        
                                    </div>
                                </td>
                                <td>Rp. {{ number_format($item->menu->price + (($item->menu->price * $item->size->count /100)),2,'.', ',') }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="fw-medium ">
                                    Rp. {{ number_format(($item->menu->price + ($item->menu->price * $item->size->count /100)) * $item->quantity,2,'.', ',') }}
                                </td>
                            </tr>
                            
                            @endforeach
                            <tr class="border-top border-top-dashed">
                                <td colspan="2"></td>
                                <td colspan="2" class="fw-medium p-0">
                                    <table class="table table-borderless mb-0 text-nowrap text-start" style="margin-left: ">
                                        <tbody>
                                            <tr class="border-top border-top-dashed">
                                                @if($order->coupon_id != null)
                                                @foreach($coupons as $coupon)
                                                <tr>
                                                    <th scope="row">Subtotal (IDR) :</th>
                                                    <th class="">Rp. {{ number_format($order->total,2,'.', ',') }}</th>
                                                </tr>
                                                
                                                <tr>
                                                    <th scope="row">Diskon :</th>
                                                    <th class="">-Rp. {{number_format($order->total * $coupon->discount / 100,2,'.', ',')}}</th>
                                                </tr>

                                                <tr>
                                                    <th scope="row">Total (IDR) :</th>
                                                    <th class="">Rp. {{ number_format($order->total - ($order->total * $coupon  ->discount / 100),2,'.', ',') }}</th>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <th scope="row">Subtotal (IDR) :</th>
                                                    <th class="">Rp. {{ number_format($order->total,2,'.', ',') }}</th>
                                                </tr>
                                                
                                                <tr>
                                                    <th scope="row">Diskon :</th>
                                                    <th class="">-Rp.0</th>
                                                </tr>

                                                <tr>
                                                    <th scope="row">Total (IDR) :</th>
                                                    <th class="">Rp. {{ number_format($order->total,2,'.', ',') }}</th>
                                                </tr>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="hstack gap-2 justify-content-start">
                    <a class="btn btn-light" href="javascript:;" onclick="load_list(1);">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->