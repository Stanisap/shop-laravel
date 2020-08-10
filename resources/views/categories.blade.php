@extends('layouts.master')

@section('title', 'Все категории')

@section('content')
    <div class="panel">
        @foreach($categories as $category)
            <a href="{{ route('category', $category->code) }}">
                <img src="{{ Storage::url($category->image) }} " width="60">
                <h2>{{ $category->name }}</h2>
            </a>
            <p>
                {{ $category->description }}
            </p>
        @endforeach
    </div>
@endsection
