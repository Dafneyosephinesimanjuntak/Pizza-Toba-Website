<x-app-layout title="Menu">
    <div id="content_list">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Daftar Menu</h4>
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
                                    <h4>Daftar {{request()->is('menu/makanan') ? 'Makanan' : 'Minuman'}}</h4>
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