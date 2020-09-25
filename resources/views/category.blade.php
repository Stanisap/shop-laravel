@extends('layouts.master')
@section('title', $category->name)

@section('content')
    <h1>
        {{ $category->name }} {{ $products->count() }}
    </h1>
    <p>
        {{ $category->description }}
    </p>
    <form method="GET" action="{{ route('category', $category->code) }}">
        <div class="filters row">
            <div class="col-sm-6 col-md-3">
                <label for="price_from"> Цена от
                    <input type="text" name="price_from" id="price_from" size="6" value="{{ request()->price_from }}">
                </label>
                <label for="price_to"> до
                    <input type="text" name="price_to" id="price_to" size="6" value="{{ request()->price_to }}">
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="hit">
                    <input type="checkbox" name="hit" id="hit" @if(request()->has('hit')) checked="checked" @endif> Хит
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="new">
                    <input type="checkbox" name="new" id="new" @if(request()->has('new')) checked="checked" @endif> Новинка
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="recommend">
                    <input type="checkbox" name="recommend" id="recommend" @if(request()->has('recommend')) checked="checked" @endif> Рекомендуем
                </label>
            </div>
            <div class="col-sm-6 col-md-3">
                <button type="submit" class="btn btn-primary">Фильтр</button>
                <a href="{{ route('category', $category->code) }}" class="btn btn-warning">Сброс</a>
            </div>
        </div>
    </form>
    <div class="row">
        @foreach($products as $product)
            @include('layouts.card', compact('product'))
        @endforeach
    </div>
    {{ $products->withQueryString()->links() }}
@endsection
