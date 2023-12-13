<div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0">Create Product</h4>
    </div>
</div>
<form id="form_input">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label for="" class="form-label">Nama Menu</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Menu" value="{{ $data->nama }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Pilih Kategori</label>
                <select name="category" class="form-select">
                    <option disabled>Pilih Kategori</option>                                        
                    <option value="Makanan" {{$data->category == "makanan"?"selected":""}}>Makanan</option>
                    <option value="Minuman" {{$data->category == "minuman"?"selected":""}}>Minuman</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Harga</label>
                <input type="number" name="price" class="form-control" placeholder="Masukkan Harga" value="{{ $data->price }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Stok</label>
                <input type="number" name="stock" class="form-control" placeholder="Masukkan Stok" value="{{ $data->stock }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Gambar</label>
                <input type="file" name="image" class="form-control" placeholder="Masukkan Gambar" value="{{ $data->image }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Deskripsi</label>
                <textarea name="description" style="height:140px;" class="form-control" placeholder="Masukkan Deskripsi">{{ $data->description }}</textarea>
            </div>
        </div>
        <div class="card-footer">
            <div class="hstack gap-2 justify-content-end">
                <a class="btn btn-light" href="javascript:;" onclick="load_list(1);">Kembali</a>
                @if($data->id)
                <button id="tombol_simpan" onclick="handle_upload('#tombol_simpan','#form_input','{{route('admin.menu.update',$data->id)}}','PATCH');" class="btn btn-primary" id="add-btn">Update Produk</button>
                @else
                <button type="submit" id="tombol_simpan" onclick="handle_upload('#tombol_simpan','#form_input','{{route('admin.menu.store')}}','POST');" class="btn btn-primary" id="add-btn">Tambah Produk</button>
                @endif
            </div>
        </div>
    </div>
</form>