<x-app-layout title="Checkout">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Checkout</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body checkout-tab">

                    <form action="#">
                        <div class="step-arrow-nav mt-n3 mx-n3 mb-3">

                            <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3 active" id="pills-finish-tab" data-bs-toggle="pill" data-bs-target="#pills-finish" type="button" role="tab" aria-controls="pills-finish" aria-selected="true" data-position="3"><i class="ri-checkbox-circle-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>Finish</button>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="text-center py-5">

                                <div class="mb-4">
                                    <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#695eef,secondary:#73dce9" style="width:120px;height:120px"></lord-icon>
                                </div>
                                <h5>Thank you ! Your Order is Completed !</h5>
                                <p class="text-muted">You will receive an order confirmation notification
                                    with
                                    details of your order.</p>

                                   <h3 class="fw-semibold pb-2">Order ID: <a href="javascript:;" class="text-decoration-underline">{{ $order->code }}</a></h3><br>
                                   <a href="{{route('web.checkout.pdf', $order->id)}}" class="btn btn-sm btn-primary me-2 fs-6  " target="_blank"  class="menu-link px-3">Cetak Struk</a>
                            </div>
                        </div>
                        <!-- end tab content -->
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

     
        <!-- end col -->
    </div>
</x-app-layout>