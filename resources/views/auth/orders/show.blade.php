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
                        @foreach($skus as $sku)
                            <tr>
                                <td>
                                    <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code, $sku]) }}">
                                        <img src="{{ Storage::url($sku->product->image) }}" alt="{{ $sku->product->name }}" width="58px">
                                        {{ $sku->product->name }}
                                    </a>
                                </td>
                                <td><span class="badge">{{$sku->pivot->count}}</span></td>
                                <td>{{ $sku->pivot->price }} {{ $order->currency->symbol }}</td>
                                <td>{{ $sku->pivot->price * $sku->pivot->count }} {{ $order->currency->symbol }}</td>
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
