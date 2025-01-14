@extends('frontend.layout.app')
@section('title', 'Home Page')
@section('css')
    <style>
        .swiper-pagination-bullet {
            background-color: #fb923c;
            opacity: 0.5;
        }

        .swiper-pagination-bullet-active {
            background-color: #f97316;
            opacity: 1;
        }
        .swiper-slide{
            background: none;
        }
    </style>
@endsection
@section('content')
    <div class="grid grid-cols-1 mt-2">
        <!-- Swiper -->
        <div class="swiper bannerSwiper">
            <div class="swiper-wrapper">

                @if ($sliders->count() > 0)
                    @foreach ($sliders as $slider)
                        <a href="{{ $slider->product_link }}" class="swiper-slide">
                            <img src="{{ asset('/storage/slider/' . $slider->image) }}" alt="{{ $slider->image }}">
                        </a>
                    @endforeach
                @else
                    <div class="swiper-slide">
                        <img src="https://placehold.co/1921x581" alt="">
                    </div>
                @endif

            </div>
            <div class="swiper-pagination text-theme"></div>
            <!-- Navigation buttons -->
            <span class="feature-swiper-button-next absolute top-[40%] -left-0 z-[9999]"><i
                    class="border border-theme rounded-full px-2 bg-theme pt-[2px] pb-[2px] fa-solid fa-arrow-left text-base md:text-2xl text-white"></i></span>
            <span class="feature-swiper-button-prev absolute top-[40%] -right-0 z-[9999]"><i
                    class="border border-theme hover:bg-theme hover:text-white rounded-full px-2 pt-[2px] pb-[2px] fa-solid fa-arrow-right text-base md:text-2xl bg-theme text-white"></i></span>


        </div>
        <!-- Swiper JS -->
    </div>


    <!-- Feature Products -->
    @if (count($feature_products) > 0)
        <div class="feature-products">
            @include('frontend.partials.home.feature-products')
        </div>
    @endif
    <!-- End Feature Products -->

    <!-- Hot Deal -->
    @if (count($hot_deals) > 0)
        <div class="hod-deal-products">
            @include('frontend.partials.home.hot-deal')
        </div>
    @endif
    <!-- End Hot Deal -->
    <!-- Best Selling -->
    @if (count($best_selling) > 0)
        <div class="best-selling-products">
            @include('frontend.partials.home.best-selling')
        </div>
    @endif
    <!-- End Best Selling -->
    <!-- Category Home Product -->
    @include('frontend.partials.home.category-home-products')
    <!-- End Category Home Product -->

    <!-- Brands -->
    @if (count($brands) > 0)
        <div class="best-selling-products">
            @include('frontend.partials.home.brands')
        </div>
    @endif
    <!-- End Brands -->

@endsection
