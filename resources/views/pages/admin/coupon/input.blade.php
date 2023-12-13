<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title row">
                    <div class="fs-4 ">
                        @if ($data->id)
                        Ubah
                        @else
                        Tambah
                        @endif
                        Kupon
                    </div>
                </div>
                <div class="card-toolbar">
                </div>
            </div>
            <div class="card-body pt-0">
                <form id="form_input">
                    <div class="row container">
                        <div class="col-lg-12 mb-2">                            
                            <select data-control="select2"  data-placeholder="Pilih Pengguna" id="user_id" name="user_id"
                            class="form-select form-select-solid">
                            <option SELECTED DISABLED>Pilih Pengguna</option>
                            @foreach ($customers as $item)
                                <option value="{{ $item->id }}" {{$item->id==$data->user_id?"selected":""}}>
                                    {{ $item->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 mb-2">
                                <label for="condition" class="required form-label">Besar Potongan</label>
                                <input type="text" class="form-control" id="discount" name="discount" value="{{ $data->discount }}"
                                placeholder="Masukkan Besar Potongan">
                            </div>
                            <div class="col-lg-12 mb-2">
                                <label for="condition" class="required form-label">Batas Penggunaan</label>
                                <input type="text" class="form-control" id="limit" name="limit" value="{{ $data->limit }}"
                                placeholder="Masukkan Batas Penggunaan">
                            </div>
                        </div><br>
                        <div class="row">                            
                            <div class="min-w-150px mt-2 text-end d-flex justify-content-center">
                                    <button type="button" onclick="load_list(1);" class="btn btn-md btn-secondary">Kembali</button>&ensp;
                                @if ($data->id)
                                    <button id="tombol_simpan"
                                    onclick="handle_upload('#tombol_simpan','#form_input','{{route('admin.coupon.update',$data->id)}}','PATCH');"
                                    class="btn btn-md btn-info">Simpan</button>
                                @else
                                    <button id="tombol_simpan"
                                    onclick="handle_upload('#tombol_simpan','#form_input','{{route('admin.coupon.store')}}','POST');"
                                    class="btn btn-md btn-info">Simpan</button>
                                @endif
                            </div>
                        </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    obj_select('user_id', 'Pilih Pengguna');
</script>