@foreach ($products as $product )

{{-- <ul class="list_search">
    <li>
        <a class="item-search" href="{{ route('courses.show', $course->id) }}">
            <div class="item-img"><img src="{{ $course->image }}" alt=""></div>

            <div class="suggest_item">
                <p class="name">{{ $course->course_name }}</p>
                <p>{{ Str::limit($course->description, 65) }}</p>
                <p>{{ number_format($course->price) }} VNĐ</p>
            </div>
        </a>
    </li>
</ul> --}}

<ul class="list_search">
    <li>
        <a class="item-search" href="{{ route('pages.chitietsanpham', ['id' => $product->id, 'slug' => $product->slug]) }}">
            <div class="item-img"><img src="{{ asset($product->image[0]->url) }}" alt=""></div>

            <div class="suggest_item">
                <p class="name">{{ $product->ten_san_pham }}</p>
                <p> {{ number_format($product->gia_ban) }} VNĐ</p>
            </div>
        </a>
    </li>
</ul>

@endforeach
