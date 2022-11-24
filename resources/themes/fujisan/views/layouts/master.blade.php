<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <title>@yield('page_title')</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="content-language" content="{{ app()->getLocale() }}">


    <link rel="stylesheet" href="{{ asset('custom/custom.css') }}">

    <link rel="stylesheet" href="{{ bagisto_asset('css/leaflet.min.css') }}">
    <link rel="stylesheet" href="{{ bagisto_asset('css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ bagisto_asset('css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ bagisto_asset('css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ bagisto_asset('css/slicknav.min.css') }}">
    <link rel="stylesheet" href="{{ bagisto_asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ bagisto_asset('css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ bagisto_asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ bagisto_asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ bagisto_asset('css/style.min.css') }}">
    <link rel="stylesheet" href="{{ bagisto_asset('css/helper.min.css') }}">

    {{-- begin toarst --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    {{-- end toarst  --}}

    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @if ($favicon = core()->getCurrentChannel()->favicon_url)
        <link rel="icon" sizes="16x16" href="{{ $favicon }}" />
    @else
        <link rel="icon" sizes="16x16" href="{{ bagisto_asset('images/favicon.ico') }}" />
    @endif

    @yield('head')

    @section('seo')
        @if (! request()->is('/'))
            <meta name="description" content="{{ core()->getCurrentChannel()->description }}"/>
        @endif
    @show

    @stack('css')

    <!--== Google Fonts ==-->
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,500,600,700%7CPoppins:400,400i,500,600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/001eccea69.js" crossorigin="anonymous"></script>

    {!! view_render_event('bagisto.shop.layout.head') !!}

    <style>
        {!! core()->getConfigData('general.content.custom_scripts.custom_css') !!}
    </style>

</head>


<body @if (core()->getCurrentLocale() && core()->getCurrentLocale()->direction == 'rtl') class="rtl" @endif style="scroll-behavior: smooth;">

    {!! view_render_event('bagisto.shop.layout.body.before') !!}

    <div id="app">
        <flash-wrapper ref='flashes'></flash-wrapper>

        <div class="main-container-wrapper">

            {!! view_render_event('bagisto.shop.layout.header.before') !!}

            @include('shop::layouts.header.index')

            {!! view_render_event('bagisto.shop.layout.header.after') !!}

            @yield('slider')

            <main class="">

                {!! view_render_event('bagisto.shop.layout.content.before') !!}

                @yield('content-wrapper')

                {!! view_render_event('bagisto.shop.layout.content.after') !!}

            </main>

        </div>

        {!! view_render_event('bagisto.shop.layout.footer.before') !!}

        @include('shop::layouts.footer.footer')

        {!! view_render_event('bagisto.shop.layout.footer.after') !!}

        @if (core()->getConfigData('general.content.footer.footer_toggle'))
            <div class="footer">
                <p style="text-align: center;">
                    @if (core()->getConfigData('general.content.footer.footer_content'))
                        {{ core()->getConfigData('general.content.footer.footer_content') }}
                    @else
                        {!! trans('admin::app.footer.copy-right') !!}
                    @endif
                </p>
            </div>
        @endif

        <overlay-loader :is-open="show_loader"></overlay-loader>
    </div>

    <script type="text/javascript">
        window.flashMessages = [];

        @if ($success = session('success'))
            window.flashMessages = [{'type': 'alert-success', 'message': "{{ $success }}" }];
        @elseif ($warning = session('warning'))
            window.flashMessages = [{'type': 'alert-warning', 'message': "{{ $warning }}" }];
        @elseif ($error = session('error'))
            window.flashMessages = [{'type': 'alert-error', 'message': "{{ $error }}" }];
        @elseif ($info = session('info'))
            window.flashMessages = [{'type': 'alert-info', 'message': "{{ $info }}" }];
        @endif

        window.serverErrors = [];

        @if (isset($errors))
            @if (count($errors))
                window.serverErrors = @json($errors->getMessages());
            @endif
        @endif
    </script>

    <script type="text/javascript" src="{{ bagisto_asset('js/shop.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>

    @stack('scripts')

    {!! view_render_event('bagisto.shop.layout.body.after') !!}

    <div class="modal-overlay"></div>

    <script>
        {!! core()->getConfigData('general.content.custom_scripts.custom_javascript') !!}
    </script>


    <!-- Scroll Top Button -->
    <button class="btn-scroll-top"><i class="ion-chevron-up"></i></button>
    
    <!--== Start Responsive Menu Wrapper ==-->
    <aside class="off-canvas-wrapper off-canvas-menu">
        <div class="off-canvas-overlay"></div>
        <div class="off-canvas-inner">
            <!-- Start Off Canvas Content -->
            <div class="off-canvas-content">
                <div class="off-canvas-header">
                    <div class="logo">
                        <a href="{{ route('shop.home.index') }}" aria-label="Logo">
                            @if ($logo = core()->getCurrentChannel()->logo_url)
                                <img class="logo" src="{{ $logo }}" alt="Logo" />
                            @else
                                <img class="logo" src="{{ bagisto_asset('img/logo.png') }}" alt="Logo" />
                            @endif
                        </a>
                    </div>
                    <div class="close-btn">
                        <button class="btn-close"><i class="ion-android-close"></i></button>
                    </div>
                </div>

                <!-- Content Auto Generate Form Main Menu Here -->
                <div class="res-mobile-menu mobile-menu">

                </div>
            </div>
        </div>
    </aside>
    <!--== End Responsive Menu Wrapper ==-->

    <!--=======================Javascript============================-->
    <!-- build:js assets/js/app.min.js -->
    <!--=== Modernizr Min Js ===-->
    <script src="{{ bagisto_asset('js/modernizr-3.6.0.min.js') }}"></script>
    <!--=== jQuery Min Js ===-->
    <script src="{{ bagisto_asset('js/jquery.min.js') }}"></script>
    <!--=== jQuery Migration Min Js ===-->
    <script src="{{ bagisto_asset('js/jquery-migrate.min.js') }}"></script>
    <!--=== Popper Min Js ===-->
    <script src="{{ bagisto_asset('js/popper.min.js') }}"></script>
    <!--=== Bootstrap Min Js ===-->
    <script src="{{ bagisto_asset('js/bootstrap.min.js') }}"></script>
    <!--=== Slicknav Min Js ===-->
    <script src="{{ bagisto_asset('js/jquery.slicknav.min.js') }}"></script>
    <!--=== Magnific Popup Min Js ===-->
    <script src="{{ bagisto_asset('js/jquery.magnific-popup.min.js') }}"></script>
    <!--=== Slick Slider Min Js ===-->
    <script src="{{ bagisto_asset('js/slick.min.js') }}"></script>
    <!--=== Nice Select Min Js ===-->
    <script src="{{ bagisto_asset('js/jquery.nice-select.min.js') }}"></script>
    <!--=== Leaflet Min Js ===-->
    <script src="{{ bagisto_asset('js/leaflet.min.js') }}"></script>
    <!--=== Countdown Js ===-->
    <script src="{{ bagisto_asset('js/countdown.js') }}"></script>

    <!--=== Active Js ===-->
    <script src="{{ bagisto_asset('js/active.js') }}"></script>
    <!-- endbuild -->

    {{-- toarst part --}}
    {{-- toastr js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script>
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
    {{-- end toarst --}}
</body>

</html>