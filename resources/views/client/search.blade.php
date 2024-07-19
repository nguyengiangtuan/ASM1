@extends('client.layouts.master')
@section('content')
    <h1>Search results for "{{ $query }}"</h1>
    @if ($news->isEmpty())
        <p>No news found for "{{ $query }}".</p>
    @else
        @foreach ($news as $item)
            <div>
                <h2>{{ $item->title }}</h2>
                <p>{{ $item->content }}</p>
            </div>
        @endforeach
    @endif

@endsection
