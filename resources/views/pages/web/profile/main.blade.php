<x-app-layout title="">
    
    <div class="pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-3">
                    <div class="card mt-n5">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-2">
                                    <img src="{{ asset('images/img/user.png')}}"
                                        class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                        alt="user-profile-image">                                    
                                </div>
                                <h5 class="fs-16 mb-1 text-capitalize">{{ Auth::user()->fullname }} / <span class="text-muted">{{ Auth::user()->username }}</span> </h5>                                
                                <p class="text-muted mb-0">User</p>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <!--end col-->
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails"
                                        role="tab">
                                        Personal Details
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                        Edit Profile
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <th class="ps-0 col-md-4" scope="row">Full Name </th>
                                                    <td class="text-muted text-capitalize">{{ Auth::user()->fullname }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0 col-md-4" scope="row">Phone </th>
                                                    <td class="text-muted">{{ Auth::user()->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0 col-md-4" scope="row">E-mail </th>
                                                    <td class="text-muted">{{ Auth::user()->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0 col-md-4" scope="row">Location </th>
                                                    <td class="text-muted">
                                                        @if(Auth::user()->province_id && Auth::user()->city_id && Auth::user()->subdistrict_id)
                                                        {{ Auth::user()->address}}, {{Auth::user()->subdistrict->name}}, {{Auth::user()->postal_code}}, {{Auth::user()->city->name}}, {{Auth::user()->province->name}}. 
                                                        @else
                                                        {{ Auth::user()->address}}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0 col-md-4" scope="row">Credit Card </th>
                                                    <td class="text-muted">{{Auth::user()->card_name .', ID : '. Auth::user()->card_id}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0 col-md-4" scope="row">Joining Date </th>
                                                    <td class="text-muted">{{ \Carbon\Carbon::parse(Auth::user()->created_at)->translatedFormat('l, d F Y')}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                        <!--end row-->
                                </div>
                                <!--end tab-pane-->
                                <div class="tab-pane" id="changePassword" role="tabpanel">                                    
                                    <form id="form_input" >
                                        {{-- @method('PATCH')
                                        @csrf --}}
                                        <div class="row">
                                           <div class="col-lg-6">
                                               <div class="mb-3">
                                                   <label for="firstnameInput" class="form-label">Fullname</label>
                                                   <input type="text" class="form-control" name="fullname" id="firstnameInput"
                                                       placeholder="Enter your firstname" value="{{ Auth::user()->fullname }}">
                                               </div>
                                           </div>
                                           <!--end col-->
                                           <!--end col-->
                                           <div class="col-lg-6">
                                               <div class="mb-3">
                                                   <label for="phonenumberInput" class="form-label">No.Telepon</label>
                                                   <input type="text" class="form-control"
                                                       id="phonenumberInput" name="phone"
                                                       placeholder="Enter your phone number"
                                                       value="{{ Auth::user()->phone }}">
                                               </div>
                                           </div>
                                           <!--end col-->
                                           <div class="col-lg-6">
                                               <div class="mb-3">
                                                   <label for="emailInput" class="form-label">Email</label>
                                                   <input type="email" class="form-control" id="emailInput"
                                                       placeholder="Enter your email" name="email"
                                                       value="{{ Auth::user()->email }}">
                                               </div>
                                           </div>
                                           
                                           <div class="col-lg-6">
                                               <div class="mb-3">
                                                   <label for="address" class="form-label">Alamat</label>
                                                   <input type="text" class="form-control" minlength="5"
                                                       maxlength="50" id="address" name="address"
                                                       placeholder="Enter zipcode" value="{{ Auth::User()->address }}">
                                               </div>
                                           </div>
                                           <div class="col-lg-3">
                                               <div class="mb-3">
                                                   <label for="province" class="form-label">Provinsi</label>
                                                   <select class="form-control" data-choices id="province" name="province"
                                                       data-plugin="choices">
                                                       <option value="">Select Province</option>
                                                       @foreach($provinces as $province)
                                                       <option value="{{ $province->id }}" {{ Auth::guard('web')->user()->province_id==$province->id?'selected':''}}>{{ $province->name }}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                           </div>
   
                                           <div class="col-lg-3">
                                               <div class="mb-3">
                                                   <label for="city" class="form-label">Kota</label>
                                                   <select class="form-control" data-choices id="city" name="city">
                                                       @if(Auth::guard('web')->user()->city_id == null)
                                                       <option value="">Select Kota</option>
                                                       @else
                                                       @foreach($cities as $city)
                                                       <option value="{{ $city->id }}" {{ Auth::guard('web')->user()->city_id==$city->id?'selected':''}}>{{ $city->name }}
                                                       </option>
                                                       @endforeach
                                                       @endif
                                                   </select>
                                               </div>
                                           </div>
   
                                           <div class="col-lg-3">
                                               <div class="mb-3">
                                                   <label for="district" class="form-label">Kecamatan</label>
                                                   <select class="form-control" data-choices id="subdistrict" name="subdistrict">
                                                       @if(Auth::guard('web')->user()->subdistrict_id == null)
                                                       <option value="">Select Kecamatan</option>
                                                       @else
                                                       @foreach($subdistricts as $subdistrict)
                                                       <option value="{{ $subdistrict->id }}" {{ Auth::guard('web')->user()->subdistrict_id==$subdistrict->id?'selected':''}}>{{ $subdistrict->name }}
                                                       </option>
                                                       @endforeach
                                                       @endif
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Kode Pos</label>
                                                <input type="text" class="form-control" minlength="5"
                                                    maxlength="50" id="address" name="postal_code"
                                                    placeholder="Enter zipcode" value="{{ Auth::User()->postal_code }}">
                                            </div>
                                            </div>
                                           <div class="col-lg-6">
                                               <div class="mb-3">
                                                   <label for="address" class="form-label">Nama Kartu</label>
                                                   <input type="text" class="form-control" minlength="5"
                                                       maxlength="50" id="address" name="card_name"
                                                       placeholder="Enter zipcode" value="{{ Auth::User()->card_name }}">
                                               </div>
                                           </div>
                                           <div class="col-lg-6">
                                               <div class="mb-3">
                                                   <label for="address" class="form-label">Nomor Kartu</label>
                                                   <input type="text" class="form-control" minlength="5"
                                                       maxlength="50" id="address" name="card_id"
                                                       placeholder="Enter zipcode" value="{{ Auth::User()->card_id }}">
                                               </div>
                                           </div>                                    
                                           <div class="col-lg-12">
                                               <div class="hstack gap-2 justify-content-end">
                                                   <a href="javascript:;" id="tombol_simpan" onclick="update_profile('#tombol_simpan','#form_input','{{route('web.profile.update')}}','PATCH')"  class="btn btn-primary">Edit</a>                                                   
                                               </div>
                                           </div>                                           
                                        </div> 
                                       </form>
                                    <!--end col-->
                                </div>
                                <!--end tab-pane-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div><!-- End Page-content -->
    @section('custom_js')
    <script>
        $("#province").change(function () {
            $.post('{{route('web.regional.city')}}', {
                    province: $("#province").val()
                },
                function (result) {
                    $("#city").html(result);
                }, "html");
        });
        $("#city").change(function () {
            $.post('{{route('web.regional.subdistrict')}}', {
                    city: $("#city").val()
                },
                function (result) {
                    $("#subdistrict").html(result);
                }, "html");
        });

        function update_profile(tombol, form, url, method, title) {
    $(tombol).submit(function () {
        return false;
    });
    let data = $(form).serialize();
    $(tombol).prop("disabled", true);
    $(tombol).html("Please wait");
    $.ajax({
        type: method,
        url: url,
        data: data,
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            if (response.alert == "success") {
                Swal.fire({
                    text: response.message,
                    icon: "success",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, Mengerti!",
                    customClass: { confirmButton: "btn btn-primary" },
                }).then(function () {
                    location.reload();
                });
                $(form)[0].reset();
                setTimeout(function () {
                    $(tombol).prop("disabled", false);
                    $(tombol).html(title);
                    main_content("content_list");
                }, 2000);
            } else {
                Swal.fire({
                    text: response.message,
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, Mengerti!",
                    customClass: { confirmButton: "btn btn-primary" },
                });
                setTimeout(function () {
                    $(tombol).prop("disabled", false);
                    $(tombol).html(title);
                }, 2000);
            }
        },
    });
}
    </script>
    @endsection
</x-app-layout>