<div class="card-body">
       <div>
           <div class="table-responsive table-card mb-1">
               <table class="table align-middle">
                   <thead class="table-light text-muted text-center">
                       <tr>
                           <th>No</th>
                           <th>Kode Kupon</th>
                           <th>Jumlah Diskon</th>
                           <th>Batas Penggunaan</th>
                           <th>Telah Digunakan</th>
                           
                       </tr>
                   </thead>
                   <tbody class="list form-check-all text-center">
                       @foreach($coupons as $key => $item)
                       <tr>
                           <td>{{$coupons->firstItem() + $key }}</td>
                           <td>{{$item->code}}</td>
                           <td>{{$item->discount}}%</td>
                           <td>{{ $item->limit }}</td>
                           <td>{{$item->used}}</td>
                       </tr>
                       @endforeach
                   </tbody>
               </table>
           </div>
       </div>
   </div>
   {{ $coupons->links('theme.app.pagination') }} <br>