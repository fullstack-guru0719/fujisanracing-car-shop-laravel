@if (count($sliderData))
    <!--== Start Slider Area Wrapper ==-->
    <div class="slider-area-wrapper">
        <div class="slider-content-active">
            @foreach ($sliderData as $slider)
                <div class="slider-slide-item bg-img" data-bg-opacity="0.4" data-bg="{{ url()->to('/') }}/storage/{{ $slider['path'] }}">
                    <div class="container container-wide h-100">
                        <div class="row align-items-center h-100">
                            <div class="col-lg-6">
                                <div class="slide-content">
                                    <div class="slide-content-inner">
                                        <h3>{{ $slider['title'] }}</h3>
                                        {!! $slider['content'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!--== End Slider Area Wrapper ==-->
@endif