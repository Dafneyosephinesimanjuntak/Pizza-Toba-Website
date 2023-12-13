<x-app-layout title="Dashboard">
    <h5>Dashboard</h5>
    <div class="row">
        <div class="col-xxl-6 col-md-6">
            <div class="card card-animate">
                <div class="card-body text-center">
                    <div class="d-flex mb-1">
                        <div class="flex-grow-1">
                            <lord-icon
                                src="https://cdn.lordicon.com/dxjqoygy.json"
                                trigger="loop"
                                style="width:60px;height:60px">
                            </lord-icon>
                        </div>
                        
                    </div> 
                    <h3 class="mb-2"><span class="counter-value" data-target="{{$total_user}}">0</span><small class="text-muted fs-13"></small></h3>
                    <h6 class="text-muted mb-0">Total User</h6>
                </div>
            </div><!--end card-->
        </div><!--end col-->
        <div class="col-xxl-6 col-md-6">
            <div class="card card-animate">
                <div class="card-body text-center">
                    <div class="d-flex mb-1">
                        <div class="flex-grow-1">
                            <lord-icon
                                src="https://cdn.lordicon.com/nocovwne.json"
                                trigger="loop"
                                style="width:60px;height:60px">
                            </lord-icon>
                        </div>
                        
                    </div> 
                    <h3 class="mb-2"><span class="counter-value" data-target="{{$total_order}}">0</span><small class="text-muted fs-13"></small></h3>
                    <h6 class="text-muted mb-0">Total Order (Pending)</h6>
                </div>
            </div><!--end card-->
        </div><!--end col-->
        
    </div><!--end row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="invoiceList">
                <div class="card-header border-0">
                    <div class="card-body">
                        <div>
                            <div class="table-responsive text-center container">
                                <lord-icon
                                    src="https://cdn.lordicon.com/eszyyflr.json"
                                    trigger="loop"
                                    style="width:130px;height:130px">
                                </lord-icon>
                            </div>                        
                        </div>                    
                    </div>
                    <div class="d-flex align-items-center">
                        <h2 class="mb-0 flex-grow-1 text-center">Welcome Back {{Auth::user()->fullname}}!</h2>                        
                    </div><br>
                    <div class="d-flex align-items-center justify-content-center pb-5">
                        <h4 class="mb-0 flex-grow-1 text-center">PizzaToba</h4>                        
                    </div>
                </div>
                
            </div>

        </div>
        <!--end col-->
    </div>
</x-app-layout>