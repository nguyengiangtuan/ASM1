@extends('client.layouts.master')
@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">{{ $news->title }}</h1>
    @if ($news->image_url)
    <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="mb-4">
@endif

    <p class="text-gray-600">{{ $news->content }}</p>
    <a href="{{ url('/') }}" class="text-blue-500 hover:underline">Quay lại</a>
</div>
@endsection
