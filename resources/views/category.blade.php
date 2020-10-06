@extends('layouts.master')
@section('title', __('main.category') . $category->__('name'))

@section('content')
    <h1>
        {{ $category->__('name') }} {{ $products->count() }}
    </h1>
    <p>
        {{ $category->__('description') }}
    </p>
    <form method="GET" action="{{ route('category', $category->code) }}">
        <div class="filters row">
            <div class="col-sm-4 col-md-4">
                <label for="price_from"> @lang('main.property.price') @lang('main.property.from')
                    <input type="text" name="price_from" id="price_from" size="6" value="{{ request()->price_from }}">
                </label>
                <label for="price_to"> @lang('main.property.to')
                    <input type="text" name="price_to" id="price_to" size="6" value="{{ request()->price_to }}">
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="hit">
                    <input type="checkbox" name="hit" id="hit" @if(request()->has('hit')) checked="checked" @endif> @lang('main.property.hit')
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="new">
                    <input type="checkbox" name="new" id="new" @if(request()->has('new')) checked="checked" @endif> @lang('main.property.new')
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="recommend">
                    <input type="checkbox" name="recommend" id="recommend" @if(request()->has('recommend')) checked="checked" @endif> @lang('main.property.recommend')
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <button type="submit" class="btn btn-primary">@lang('main.property.filter')</button>
                <a href="{{ route('category', $category->code) }}" class="btn btn-warning">@lang('main.property.reset')</a>
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
