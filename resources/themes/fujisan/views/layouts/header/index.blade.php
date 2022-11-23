<?php
    $term = request()->input('term');
    $image_search = request()->input('image-search');

    if (! is_null($term)) {
        $serachQuery = 'term='.request()->input('term');
    }
?>

<header class="header-area" id="header">    
    <div class="container container-wide">
            <div class="row align-items-center">
                <div class="col-sm-4 col-lg-2">
                    <div class="site-logo text-center text-sm-left">
                        <a href="{{ route('shop.home.index') }}" aria-label="Logo">
                            @if ($logo = core()->getCurrentChannel()->logo_url)
                                <img class="logo" src="{{ $logo }}" alt="" />
                            @else
                                <img class="logo" src="{{ bagisto_asset('img/logo.png') }}" alt="" />
                            @endif
                        </a>
                    </div>
                    <!--make search box-->
                </div>

                <div class="col-lg-5 d-none d-lg-block">
                    @include('shop::layouts.header.nav-menu.navmenu')
                </div>

                <div class="col-sm-8 col-lg-5">
                    <div class="site-action d-flex justify-content-center justify-content-sm-end align-items-center">
                        
                    <ul class="login-reg-nav nav">
                        
                        {!! view_render_event('bagisto.shop.layout.header.compare-item.before') !!}

                        @php
                            $showCompare = core()->getConfigData('general.content.shop.compare_option') == "1" ? true : false
                        @endphp

                        @if ($showCompare)
                            <li class="compare-dropdown-container">
                                <a
                                    @auth('customer')
                                        href="{{ route('velocity.customer.product.compare') }}"
                                    @endauth

                                    @guest('customer')
                                        href="{{ url('/comparison') }}"
                                    @endguest
                                    >

                                    <i class="icon compare-icon"></i>
                                    <span class="name">
                                        {{ __('shop::app.customer.compare.text') }}
                                        <span class="count">(<span id="compare-items-count"></span>)<span class="count">
                                    </span>
                                </a>
                            </li>
                        @endif

                        {!! view_render_event('bagisto.shop.layout.header.compare-item.after') !!}

                        {!! view_render_event('bagisto.shop.layout.header.currency-item.before') !!}

                        @if (false && core()->getCurrentChannel()->currencies->count() > 1)
                            <li class="currency-switcher">
                                <span class="dropdown-toggle">
                                        {{ core()->getCurrentCurrencyCode() }}
                                </span>
                                <ul class="dropdown-list currency">
                                    @foreach (core()->getCurrentChannel()->currencies as $currency)
                                        <li>
                                            @if (isset($serachQuery))
                                                <a href="?{{ $serachQuery }}&currency={{ $currency->code }}">{{ $currency->code }}</a>
                                            @else
                                                <a href="?currency={{ $currency->code }}">{{ $currency->code }}</a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif

                        {!! view_render_event('bagisto.shop.layout.header.currency-item.after') !!}


                        {!! view_render_event('bagisto.shop.layout.header.account-item.before') !!}


                        @guest('customer')
                            <li>
                                <a href="{{ route('customer.session.index') }}">
                                    {{ __('shop::app.header.sign-in') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('customer.register.index') }}">
                                    {{ __('shop::app.header.sign-up') }}
                                </a>
                            </li>
                        @endguest

                        @auth('customer')
                            @php
                                $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ? true : false;
                            @endphp

                            <li>
                                <a href="{{ route('customer.profile.index') }}">{{ __('shop::app.header.profile') }}</a>
                            </li>

                            @if ($showWishlist)
                                <li>
                                    <a href="{{ route('customer.wishlist.index') }}">{{ __('shop::app.header.wishlist') }}</a>
                                </li>
                            @endif
                            
                            <li>
                                <a href="{{ route('customer.session.destroy') }}">{{ __('shop::app.header.logout') }}</a>
                            </li>
                        @endauth
                        </ul>

                        <div class="mini-cart-wrap">
                            @include('shop::checkout.cart.mini-cart')
                        </div>

                        <div class="responsive-menu d-lg-none">
                            <button class="btn-menu">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</header>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/mobilenet" defer></script>

    <script type="text/x-template" id="image-search-component-template">
        <div v-if="image_search_status">
            <label class="image-search-container" :for="'image-search-container-' + _uid">
                <i class="icon camera-icon"></i>

                <input type="file" :id="'image-search-container-' + _uid" ref="image_search_input" v-on:change="uploadImage()"/>

                <img :id="'uploaded-image-url-' +  + _uid" :src="uploaded_image_url" alt="" width="20" height="20" />
            </label>
        </div>
    </script>

    <script>

        Vue.component('image-search-component', {

            template: '#image-search-component-template',

            data: function() {
                return {
                    uploaded_image_url: '',
                    image_search_status: "{{core()->getConfigData('general.content.shop.image_search') == '1' ? 'true' : 'false'}}" == 'true'
                }
            },

            methods: {
                uploadImage: function() {
                    var imageInput = this.$refs.image_search_input;

                    if (imageInput.files && imageInput.files[0]) {
                        if (imageInput.files[0].type.includes('image/')) {
                            var self = this;

                            if (imageInput.files[0].size <= 2000000) {
                                self.$root.showLoader();

                                var formData = new FormData();

                                formData.append('image', imageInput.files[0]);

                                axios.post("{{ route('shop.image.search.upload') }}", formData, {headers: {'Content-Type': 'multipart/form-data'}})
                                    .then(function(response) {
                                        self.uploaded_image_url = response.data;

                                        var net;

                                        async function app() {
                                            var analysedResult = [];

                                            var queryString = '';

                                            net = await mobilenet.load();

                                            const imgElement = document.getElementById('uploaded-image-url-' +  + self._uid);

                                            try {
                                                const result = await net.classify(imgElement);

                                                result.forEach(function(value) {
                                                    queryString = value.className.split(',');

                                                    if (queryString.length > 1) {
                                                        analysedResult = analysedResult.concat(queryString)
                                                    } else {
                                                        analysedResult.push(queryString[0])
                                                    }
                                                });
                                            } catch (error) {
                                                self.$root.hideLoader();

                                                window.flashMessages = [
                                                    {
                                                        'type': 'alert-error',
                                                        'message': "{{ __('shop::app.common.error') }}"
                                                    }
                                                ];

                                                self.$root.addFlashMessages();
                                            };

                                            localStorage.searched_image_url = self.uploaded_image_url;

                                            queryString = localStorage.searched_terms = analysedResult.join('_');

                                            self.$root.hideLoader();

                                            window.location.href = "{{ route('shop.search.index') }}" + '?term=' + queryString + '&image-search=1';
                                        }

                                        app();
                                    })
                                    .catch(function(error) {
                                        self.$root.hideLoader();

                                        window.flashMessages = [
                                            {
                                                'type': 'alert-error',
                                                'message': "{{ __('shop::app.common.error') }}"
                                            }
                                        ];

                                        self.$root.addFlashMessages();
                                    });
                            } else {

                                imageInput.value = '';

                                        window.flashMessages = [
                                            {
                                                'type': 'alert-error',
                                                'message': "{{ __('shop::app.common.image-upload-limit') }}"
                                            }
                                        ];

                                self.$root.addFlashMessages();

                            }
                        } else {
                            imageInput.value = '';

                            alert('Only images (.jpeg, .jpg, .png, ..) are allowed.');
                        }
                    }
                }
            }
        });

    </script>

    <script>
        $(document).ready(function() {

            $('body').delegate('#search, .icon-menu-close, .icon.icon-menu', 'click', function(e) {
                toggleDropdown(e);
            });

            @auth('customer')
                @php
                    $compareCount = app('Webkul\Velocity\Repositories\VelocityCustomerCompareProductRepository')
                        ->count([
                            'customer_id' => auth()->guard('customer')->user()->id,
                        ]);
                @endphp

                let comparedItems = JSON.parse(localStorage.getItem('compared_product'));
                $('#compare-items-count').html({{ $compareCount }});
            @endauth

            @guest('customer')
                let comparedItems = JSON.parse(localStorage.getItem('compared_product'));
                $('#compare-items-count').html(comparedItems ? comparedItems.length : 0);
            @endguest

            function toggleDropdown(e) {
                var currentElement = $(e.currentTarget);

                if (currentElement.hasClass('icon-search')) {
                    currentElement.removeClass('icon-search');
                    currentElement.addClass('icon-menu-close');
                    $('#hammenu').removeClass('icon-menu-close');
                    $('#hammenu').addClass('icon-menu');
                    $("#search-responsive").css("display", "block");
                    $("#header-bottom").css("display", "none");
                } else if (currentElement.hasClass('icon-menu')) {
                    currentElement.removeClass('icon-menu');
                    currentElement.addClass('icon-menu-close');
                    $('#search').removeClass('icon-menu-close');
                    $('#search').addClass('icon-search');
                    $("#search-responsive").css("display", "none");
                    $("#header-bottom").css("display", "block");
                } else {
                    currentElement.removeClass('icon-menu-close');
                    $("#search-responsive").css("display", "none");
                    $("#header-bottom").css("display", "none");
                    if (currentElement.attr("id") == 'search') {
                        currentElement.addClass('icon-search');
                    } else {
                        currentElement.addClass('icon-menu');
                    }
                }
            }
        });
    </script>
@endpush