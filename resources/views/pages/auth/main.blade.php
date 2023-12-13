<x-auth-layout title="Login">
    <div id="page_login">
        <div class="p-lg-5 p-4" >
            <div>
                <h2 class="text-dark text-center fs-30">Login</h2>
            </div>

            <div class="mt-4">
                <form class="auth-login-form mt-2" id="login_form">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label text-white fs-18">Username</label>
                        <input type="text" name="username" class="form-control " id="username" placeholder="Enter Username">
                        <div class="invalid-feedback">
                            Masukkan Username Anda
                        </div>   
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white fs-18" for="password-input">Password</label>
                        <div class="position-relative auth-pass-inputgroup mb-3">
                            <input type="password" name="password" class="form-control pe-5  @error('password') is-invalid @enderror" placeholder="Enter Password" id="password-input">
                            
                            <div class="invalid-feedback">
                                Masukkan Password Anda
                            </div>   
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <div class="col-md-4 mx-auto">
                            <button id="tombol_login" class="btn btn-secondary w-100" type="submit" onclick="handle_login('#tombol_login','#login_form','{{route('auth.login')}}','POST');">Login</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="mt-3 text-center">
                <p class="mb-0">Tidak Memiliki Akun? <a href="javascript:;" class="fw-semibold text-info text-decoration-underline" onclick="auth_content('page_register');">Daftar Disini</a> </p>
            </div>
        </div>
    </div>
    <div id="page_register">
        <div class="p-lg-5 p-4" >
            <div>
                <h2 class="text-dark text-center">Daftar Akun</h2>
            </div>

            <div class="mt-4">
                <form class="auth-register-form mt-2" id="register_form">
                    @csrf

                    <div class="mb-2">
                        <label for="fullname" class="form-label text-white fs-18">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="fullname" class="form-control " id="fullname" placeholder="Masukkan Nama Lengkap Anda" >  
                        <div class="invalid-feedback">
                            Masukkan Nama Lengkap Anda
                        </div>      
                    </div>
                    <div class="mb-2">
                        <label for="fullname" class="form-label text-white fs-18">Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" class="form-control " id="username" placeholder="Masukkan Username Anda" >  
                        <div class="invalid-feedback">
                            Masukkan Username Anda
                        </div>      
                    </div>

                    <div class="mb-2">
                        <label for="email" class="form-label text-white fs-18">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="email" placeholder="Masukkan Email Anda" >  
                        <div class="invalid-feedback">
                            Masukkan Email Anda
                        </div>      
                    </div>
                    
                    <div class="mb-2">
                        <label for="password" class="form-label text-white fs-18">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="password" placeholder="Masukkan Password " >
                        <div class="invalid-feedback">
                            Masukkan Password Anda
                        </div>       
                    </div>
                    
                    <div class="mb-2">
                        <label for="password_confirmation" class="form-label text-white fs-18">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control  @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Masukkan Password " >
                        <div class="invalid-feedback">
                            Masukkan Password Anda
                        </div>
                    <div class="mt-4 col-md-4 mx-auto">
                        <button id="tombol_register" class="btn btn-secondary w-100" type="submit" onclick="handle_post('#tombol_register','#register_form','{{route('auth.register')}}','POST');">Daftar</button>
                    </div>
                </form>
            </div>

            <div class="mt-2 text-center">
                <p class="mb-0">Sudah Memiliki Akun? <a href="javascript:;" class="fw-semibold text-info text-decoration-underline" onclick="auth_content('page_login');">Login Disini</a> </p>
            </div>
        </div>
    </div>
    @section('custom_js')
    <script>
        auth_content('page_login');
        function handle_login(tombol,form,url,method){
            $(tombol).attr('disabled',true);
            $(tombol).html('<i class="ri-refresh-line spin"></i>');
            $.ajax({
                url: url,
                method: method,
                data: $(form).serialize(),
                success: function(response){
                    if(response.alert == 'success'){
                        Swal.fire({ text: response.message, icon: "success", buttonsStyling: !1, confirmButtonText: "Ok, Mengerti!", customClass: { confirmButton: "btn btn-primary" } }).then(function() {
                            window.location.href = response.redirect;
                        });
                    }else{
                        $(tombol).attr('disabled',false);
                        $(tombol).html('Login');
                        Swal.fire({ text: response.message, icon: "error", buttonsStyling: !1, confirmButtonText: "Ok, Mengerti!", customClass: { confirmButton: "btn btn-primary" } });
                    }
                },
            });
        }
    </script>
    @endsection
</x-auth-layout>