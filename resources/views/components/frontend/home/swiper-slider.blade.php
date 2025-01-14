
<!-- Swiper -->
    <div class="swiper bannerSwiper">
        <div class="swiper-wrapper">

            @if($sliders->count() > 0)
                @foreach($sliders as $slider)
                    <div class="swiper-slide">
                        <img src="{{ asset('/storage/slider/'.$slider->image) }}" alt="{{ $slider->image }}">
                    </div>
                @endforeach
                @else
                <div class="swiper-slide">
                    <img src="https://placehold.co/1921x581" alt="">
                </div>
            @endif

        </div>
        <div class="swiper-pagination"></div>
    </div>
<!-- Swiper JS -->

@section('js')

    <script>
        let swiper = new Swiper(".bannerSwiper", {
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
        });
    </script>
@endsection
