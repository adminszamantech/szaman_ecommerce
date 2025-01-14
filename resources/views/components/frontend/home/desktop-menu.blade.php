@section('css')
    <style>
        .arrow-before::before {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            right: 15px;
            bottom: 0;
            top: 0;
            background-image: url('data:image/svg+xml;base64,PHN2ZyBkYXRhLW5hbWU9IkNvbXBvbmVudCAxOCDigJMgOCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTYiIGhlaWdodD0iMTYiPjxwYXRoIGRhdGEtbmFtZT0iUGF0aCAxMjY3IiBkPSJNNSAybDYgNi02IDYiIGZpbGw9Im5vbmUiIHN0cm9rZT0iI2ExYTFhMSIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBzdHJva2Utd2lkdGg9IjEuNSIvPjwvc3ZnPg=='); /* Replace with your arrow icon URL */
            background-size: cover;
            margin: auto;
        }
    </style>
@endsection

    <ul class="py-4">
        @foreach($menu_categories as $menu_category)
        <li class="group">
            <a href="{{ route('frontend.category.page', $menu_category->slug) }}" class="@if(count($menu_category->sub_category) > 0) arrow-before @endif  block relative px-4 py-2 text-[14px] hover:text-[#eb5d1e]">{{$menu_category->name}}</a>
            @if(count($menu_category->sub_category) > 0)
                <div class="sub-menu hidden group-hover:grid group-hover:grid-cols-2 text-[13px] bg-white absolute py-4 top-0 left-full z-20 w-full shadow-lg">
                    @foreach($menu_category->sub_category as $menu_subcategory)
                        <a href="" class="py-2 px-6">{{ $menu_subcategory->name }}</a>
                    @endforeach

                </div>
            @endif
        </li>
        @endforeach

    </ul>
