<div class="card-body">
       <div>
           <div class="table-responsive table-card mb-1">
               <table class="table align-middle text-center">
                   <thead class="table-light text-muted">
                       <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>Kode Kupon</th>
                            <th>Jumlah Diskon</th>
                            <th>Batas Penggunaan</th>
                            <th>Telah Digunakan</th>
                           <th>Aksi</th>
                       </tr>
                   </thead>
                   <tbody class="list form-check-all">
                       @foreach($coupons as $key => $item)
                       <tr>
                           <td >{{$coupons->firstItem() + $key }}</td>
                           <td class="text-capitalize">{{$item->user->fullname}}</td>
                           <td class="text-capitalize">{{$item->code}}</td>
                           <td class="text-capitalize">{{$item->discount}}%</td>
                           <td class="text-capitalize">{{$item->limit}}</td>
                           <td class="text-capitalize">{{$item->used}}</td>
                           <td>
                               <ul class="list-inline gap-2 mb-0">                                   
                                   <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                       data-bs-placement="top" title="" data-bs-original-title="Edit">
                                       <a href="javascript:;"
                                           onclick="load_input('{{route('admin.coupon.edit',$item->id)}}')"
                                           class="text-primary d-inline-block edit-item-btn">
                                           <i class="ri-pencil-fill fs-16"></i>
                                       </a>
                                   </li>
                                   <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                       data-bs-placement="top" title="" data-bs-original-title="Remove">
                                       <a href="javascript:;"
                                           onclick="handle_confirm('Apakah Anda Yakin?','Yakin','Tidak','DELETE','{{route('admin.coupon.destroy',$item->id)}}');"
                                           class="text-danger d-inline-block remove-item-btn">
                                           <i class="ri-delete-bin-5-fill fs-16"></i>
                                       </a>
                                   </li>
                               </ul>
   
                           </td>
                       </tr>
                       @endforeach
                   </tbody>
               </table>
           </div>
       </div>
   </div>
   {{ $coupons->links('theme.app.pagination') }} <br>