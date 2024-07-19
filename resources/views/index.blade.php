@extends('client.layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h2>Danh mục tin</h2>
            <ul>
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('category', $category->id) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-8">
            <h2>Tin tức mới nhất</h2>
            @foreach ($news as $item)
                <div>
                    <h3>{{ $item->title }}</h3>
                    <p>{{ $item->content }}</p>
                    <p><img src="{{$item->image_url}}" alt=""></p>
                    <p><a href="{{ route('client.show', $item->id) }}">Xem chi tiết</a></p>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
