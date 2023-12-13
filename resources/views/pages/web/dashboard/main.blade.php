<x-app-layout title="Home">
    <div id="content_list">
        <div class="row">
            <div class="col-12">
                
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header border-0" style="text-align: justify">
                   <h2>Selamat Datang di Pizza Toba!</h2>
                   <h5 class="" style="text-indent: 2rem">Haloo masyarakat Toba!! Pizza Toba kini sudah hadir 
                    Mulai harga 30ribuan aja kamu udah bisa menikmati Pizza Toba yang rasanya oke banget! </h5>
                    <h5 style="text-indent: 2rem">                    
                    Yuk jangan lupa mampir ke toko Pizza Toba, kamu juga dapat memesannya secara langsung via sistem jika tidak ingin menunggu lama di toko!</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4">
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-start">
                                <div class="my-2">
                                    <h4>Daftar Menu</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                                <div class="search-box ms-2">
                                    <form id="content_filter">
                                        <input type="text" name="keyword" onkeyup="load_list(1);"
                                            class="form-control" placeholder="Search Products...">
                                        <i class="ri-search-line search-icon"></i>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="container" id="list_result"></div>
            </div>
        </div>
    </div>
    <div id="content_detail"></div>
    @section('custom_js')
        <script>
            load_list(1);
        </script>
    @endsection
</x-app-layout>