@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')

{!! view_render_event('bagisto.shop.products.view.reviews.after', ['product' => $product]) !!}

<div class="product-rating-wrap">
    @if ($total = $reviewHelper->getTotalReviews($product))
        <div class="average-rating">
            <h4>{{ $reviewHelper->getAverageRating($product) }} <span>(Overall)</span></h4>
            <span>Based on {{ $total }} Comments</span>
        </div>

        <div class="display-ratings">
            @foreach ($reviewHelper->getReviews($product)->paginate(20) as $review)
                <div class="rating-item">
                    <div class="rating-author-pic">
                        <img src="{{ bagisto_asset('img/user.png') }}" alt="author" />
                    </div>

                    <div class="rating-author-txt">
                        <div class="rating-star">
                        @for ($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                <span class="fa fa-star"></span>
                            @else
                                <span class="icon star-icon-blank"></span>
                            @endif
                        @endfor
                        </div>

                        <div class="rating-meta">
                            <h3>{{ __('shop::app.products.by', ['name' => $review->name]) }}</h3>
                            <span class="time">- {{ core()->formatDate($review->created_at, 'F d, Y') }}</span>
                        </div>

                        <p>{{ $review->comment }}</p>
                    </div>
                </div>
            @endforeach

            <?php /*
            <a href="{{ route('shop.reviews.index', $product->url_key) }}" class="view-all">
                {{ __('shop::app.products.view-all') }}
            </a>
            */ ?>

        </div>
    @endif

    @if (core()->getConfigData('catalog.products.review.guest_review') || auth()->guard('customer')->check())
        <div class="rating-form-wrapper review-form">
            <h3>Add your Review</h3>
            <form method="post" action="{{ route('shop.reviews.store', $product->product_id ) }}"  @submit.prevent="onSubmit">
                @csrf
                <div class="rating-form row">
                    <div class="col-12 control-group" :class="[errors.has('rating') ? 'has-error' : '']">
                        <label for="rating" class="required">
                            {{ __('admin::app.customers.reviews.rating') }}
                        </label>
                        <div class="rating-star fix mb-20">
                            <i class="fa fa-star" onclick="calculateRating(id)" id="1"></i>
                            <i class="fa fa-star" onclick="calculateRating(id)" id="2"></i>
                            <i class="fa fa-star" onclick="calculateRating(id)" id="3"></i>
                            <i class="fa fa-star" onclick="calculateRating(id)" id="4"></i>
                            <i class="fa fa-star" onclick="calculateRating(id)" id="5"></i>
                        </div>
                        <input type="hidden" id="rating" name="rating" v-validate="'required'">
                        <div class="control-error" v-if="errors.has('rating')">@{{ errors.first('rating') }}</div>
                        <script>
                            function calculateRating(id) {
                                var a = document.getElementById(id);
                                document.getElementById("rating").value = id;

                                for (let i=1 ; i <= 5 ; i++) {
                                    if (i <= id) {
                                        document.getElementById(i).classList.add("selected");
                                    } else {
                                        document.getElementById(i).classList.remove("selected");
                                    }
                                }
                            }
                        </script>
                    </div>
                    <div class="col-md-12 p-0 m-0">
                            @if (core()->getConfigData('catalog.products.review.guest_review') && ! auth()->guard('customer')->user())
                                <div class="col-6">
                                    <div class="form-input-item mt-30 mb-40 control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                        <label for="name" class="required sr-only">
                                            {{ __('shop::app.reviews.name') }}
                                        </label>
                                        <input type="text" class="control" name="name" v-validate="'required'" placeholder="Title" value="{{ old('name') }}">
                                        <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-input-item mt-30 mb-40 control-group" :class="[errors.has('title') ? 'has-error' : '']">
                                        <label for="title" class="required sr-only">
                                            {{ __('shop::app.reviews.name') }}
                                        </label>
                                        <input type="text" class="control" name="title" v-validate="'required'" placeholder="Title" value="{{ old('title') }}">
                                        <span class="control-error" v-if="errors.has('title')">@{{ errors.first('title') }}</span>
                                    </div>
                                </div>
                            @else
                                <div class="col-12">
                                    <div class="form-input-item mt-30 mb-40 control-group" :class="[errors.has('title') ? 'has-error' : '']">
                                        <label for="title" class="required sr-only">
                                            {{ __('shop::app.reviews.name') }}
                                        </label>
                                        <input type="text" class="control" name="title" v-validate="'required'" placeholder="Title" value="{{ old('title') }}">
                                        <span class="control-error" v-if="errors.has('title')">@{{ errors.first('title') }}</span>
                                    </div>
                                </div>
                            @endif
                        <div class="col-12">
                            <div class="form-input-item mt-30 mb-40 control-group" :class="[errors.has('comment') ? 'has-error' : '']">
                                <label for="comment" class="required sr-only">
                                    {{ __('admin::app.customers.reviews.comment') }}
                                </label>
                                <input type="text" class="control" name="comment" v-validate="'required'" placeholder="Comment" value="{{ old('comment') }}">
                                <span class="control-error" v-if="errors.has('comment')">@{{ errors.first('comment') }}</span>
                            </div>
                        </div>
                        <div class="col-12 mt-22">
                            <button class="btn btn-brand">
                                {{ __('shop::app.reviews.submit') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php /*
            <div class="rating-reviews">
                <div class="rating-header">
                    <a href="{{ route('shop.reviews.create', $product->url_key) }}" class="btn btn-lg btn-primary">
                        {{ __('shop::app.products.write-review-btn') }}
                    </a>
                </div>
            </div>
        */?>
    @else
        <p>No reviews on this item yet</p>
    @endif

</div>

{!! view_render_event('bagisto.shop.products.view.reviews.after', ['product' => $product]) !!}
