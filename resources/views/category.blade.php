@extends('layout.master')

@section('title', $category->name)

@section('content')
    <div class="starter-template">
        <h1>{{ $category->name }}</h1>
        <p>
            {{ $category->description }}
        </p>
        <div class="row">
            @include('layout.card', ['category' => $category])
        </div>
    </div>
@endsection
