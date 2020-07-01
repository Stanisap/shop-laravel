
@extends('layout.master')

@section('title', 'Все категории')

@section('content')

    <div class="starter-template">
        <div class="panel">
            @foreach($categories as $category)
            <a href="{{ route('category', $category->code) }}">
                <img src="http://internet-shop.tmweb.ru/storage/categories/mobile.jpg">
                <h2>{{ $category->name }}</h2>
            </a>
            <p>
                {{ $category->description }}
            </p>
            @endforeach
        </div>
    </div>
@endsection
