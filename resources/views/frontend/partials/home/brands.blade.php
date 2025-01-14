
<!-- Swiper -->
<!--:::::::::::::::::: Category Loop :::::::::::::-->
<div class="feature-products flex flex-col gap-3 my-8">
    <div class="flex flex-row justify-center items-center shadow-xl bg-theme py-2">
        <div class="">
            <h2 class="text-base md:text-2xl text-center font-semibold text-white px-16 uppercase">BRANDS</h2>
        </div>
    </div>
    <div class="grid grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-2">
        @foreach($brands as $brand)
            <a href="{{ route('frontend.brand.page', $brand->id) }}" class="shadow-xl flex items-center justify-center p-4">
                <img src="{{ asset('storage/brand/'.$brand->image) }}" class="w-full" alt="">
            </a>
        @endforeach
    </div>
</div>

