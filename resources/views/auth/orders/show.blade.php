@extends('layouts.master')

@section('title', __('order.order_num') . $order->id)

@section('content')
    <div class="py-4">
        <div class="container">
            <justify-content-center>
                <div class="panel">
                    <h1>@lang('order.order_num'){{ $order->id }}</h1>
                    <p>@lang('order.user_name'): <b>{{ $order->name }}</b></p>
                    <p>@lang('order.user_phone'): <b>{{$order->phone}}</b></p>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>@lang('order.name')</th>
                            <th>@lang('basket.quantity')</th>
                            <th>@lang('basket.price')</th>
                            <th>@lang('basket.total')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <a href="{{ route('product', [$product->category->code, $product->code]) }}">
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" width="58px">
                                        {{ $product->name }}
                                    </a>
                                </td>
                                <td><span class="badge">{{$product->pivot->count}}</span></td>
                                <td>{{ $product->pivot->price }} {{ $order->currency->symbol }}</td>
                                <td>{{ $product->pivot->price * $product->pivot->count }} {{ $order->currency->symbol }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">@lang('basket.subtotal')</td>
                            <td>{{ $order->sum }} {{ $order->currency->symbol }}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </justify-content-center>
        </div>
    </div>
@endsection
