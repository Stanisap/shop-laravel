@extends('layouts.master')

@section('title', __('main.all_categories'))

@section('content')
    <div class="panel">
        @foreach($categories as $category)
            <a href="{{ route('category', $category->code) }}">
                <img src="{{ Storage::url($category->image) }} " width="60">
                <h2>{{ $category->__('name') }}</h2>
            </a>
            <p>
                {{ $category->__('description')}}
            </p>
        @endforeach
    </div>
@endsection
