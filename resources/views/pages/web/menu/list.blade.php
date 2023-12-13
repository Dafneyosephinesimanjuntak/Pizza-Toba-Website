<div class="row">
    @foreach ($menu as $item)
    <div class="col-sm-6 col-xl-3">
        <!-- Simple card -->
        <div class="card">
            <img class="card-img-top img-fluid" src="{{ asset('images/img/'.$item->image) }}" style="height: 150px;" alt="Card image cap">
            <div class="card-body">
                <h5 style="font-size: 1rem">
                    {{ $item->nama }} 
                </h5>
                <small class="text-muted">
                    Stok : {{$item->stock}}
                </small>
                <div class="text-end">
                    <a href="javascript:;" onclick="load_detail('{{route('web.menu.show',$item->id)}}')" class="btn btn-secondary">Detail</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
{{ $menu->links('theme.app.pagination') }} <br>