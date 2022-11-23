<!--== Start Brand Logo Area Wrapper ==-->
<div class="brand-logo-area sm-top sm-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="brand-logo-content">
                    <div class="brand-logo-item">
                        <img src="{{ bagisto_asset('img/brand-logo/cusco.png') }}" alt="Cusco Logo" />
                    </div>
                    <div class="brand-logo-item">
                        <img src="{{ bagisto_asset('img/brand-logo/blitz.png') }}" alt="Blitz Logo" />
                    </div>
                    <div class="brand-logo-item">
                        <img src="{{ bagisto_asset('img/brand-logo/hks.png') }}" alt="HKS Logo" />
                    </div>
                    <div class="brand-logo-item">
                        <img src="{{ bagisto_asset('img/brand-logo/greddy.png') }}" alt="Greddy Logo" />
                    </div>
                    <div class="brand-logo-item">
                        <img src="{{ bagisto_asset('img/brand-logo/tomei.jpg') }}" alt="Tomei Logo" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--== End Brand Logo Area Wrapper ==-->
<footer class="footer-area">
    <div class="footer-widget-area">
        <div class="container container-wide">
            <div class="row mtn-40">
                <div class="col-lg-4">
                    <div class="widget-item">
                        <div class="about-widget">
                            <a href="{{ url()->to('/') }}">
                                @if ($logo = core()->getCurrentChannel()->logo_url)
                                    <img class="logo" src="{{ $logo }}" alt="" />
                                @else
                                    <img class="logo" src="{{ bagisto_asset('img/logo.png') }}" alt="" />
                                @endif
                            </a>
                            <p>
                                Fujisan Racing supplies quality performance car parts for your japanese vehicle
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="widget-item">
                        <h4 class="widget-title">Quick Links</h4>
                        <div class="widget-body">
                            <ul class="widget-list">
                                <li><a href="{{ route('shop.cms.page', 'about-us') }}">About Us</a></li>
                                <li><a href="{{ route('shop.cms.page', 'return-policy') }}">Return Policy</a></li>
                                <li><a href="{{ route('shop.cms.page', 'refund-policy') }}">Refund Policy</a></li>
                                <li><a href="{{ route('shop.cms.page', 'terms-conditions') }}">Terms and conditions</a></li>
                                <li><a href="{{ route('shop.cms.page', 'terms-of-use') }}">Terms of Use</a></li>
                                <li><a href="{{ route('shop.cms.page', 'contact-us') }}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-2">
                    <div class="widget-item">
                        <h4 class="widget-title">Socials</h4>
                        <div class="widget-body">
                            <ul class="widget-list">
                                <li><a href="https://www.instagram.com/fujisanracing/">Instagram </a></li>
                                <li><a href="https://www.facebook.com/Fujisan-Racing-2012181392180659/"><span class="icon icon-facebook"></span>Facebook </a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="widget-item">
                        <h4 class="widget-title">Contact Us</h4>
                        <div class="widget-body">
                        <p>Unit 6 Stock Industrial Park,<br />
                            Stock Rd,<br />
                            Southend-on-Sea, SS2 5QN</p>

                            <p>01702 826160</p>
                            
                            <p><a href="sales@fujisanracing.co.uk">sales@fujisanracing.co.uk</a></p>
                        </div>
                    </div>
                </div>
                {!! DbView::make(core()->getCurrentChannel())->field('footer_content')->render() !!}
            </div>
        </div>
    </div>
</div>