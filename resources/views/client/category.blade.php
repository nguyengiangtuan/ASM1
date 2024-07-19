@extends('client.layouts.master')

@section('content')
<div class="container">
    <h2>Tin tức trong danh mục "{{ $category->name }}"</h2>
    @if ($news->isNotEmpty())
        @foreach ($news as $item)
            <div>
                <h3>{{ $item->title }}</h3>
                <p>{{ $item->content }}</p>
                @if ($item->image_url)
                    <p><img src="{{ $item->image_url }}" alt="{{ $item->title }}"></p>
                @endif
                <p><a href="{{ route('client.show', $item->id) }}">Xem chi tiết</a></p>
            </div>
        @endforeach
    @else
        <p>Hiện chưa có tin tức trong danh mục "{{ $category->name }}"</p>
    @endif
</div>
@endsection
