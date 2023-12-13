<head>

    <title>{{config('app.name') . ' - ' .$title ?? config('app.name')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="{{config('app.name')}}" />
	<meta name="keyword" content="{{$keyword ?? config('app.name')}}" />
    @yield('css')
    {{-- Icon --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/img/logo_piztob.jpeg')}}" />
   <!-- jsvectormap css -->
   <link href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

   <!--Swiper slider css-->
   <link href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

   <!-- Layout config Js -->
   <script src="{{ asset('assets/js/layout.js') }}"></script>
   <!-- Bootstrap Css -->
   <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
   <!-- Icons Css -->
   <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
   <!-- App Css-->
   <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
   <!-- custom Css-->
   <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/sweetalert.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{asset('css/toastr.css')}}" type="text/css" />
    <link href="{{asset('css/choices.min.css')}}" rel="stylesheet" type="text/css" />
    
</head>