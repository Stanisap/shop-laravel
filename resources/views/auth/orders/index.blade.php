@extends('auth.layouts.master')

@section('title', __('order.title_page'))

@section('content')
    <div class="col-md-12">
        <h1>@lang('order.orders')</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    @lang('order.user_name')
                </th>
                <th>
                    @lang('order.user_phone')
                </th>
                <th>
                    @lang('order.create_at')
                </th>
                <th>
                    @lang('order.sum')
                </th>
                <th>
                    @lang('order.action')
                </th>
            </tr>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id}}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->created_at->format('H:i d/m/Y') }}</td>
                    <td>{{ $order->sum }} {{ $order->currency->symbol }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-success" type="button"
                               href="
                               @admin
                                    {{ route('show-order', $order) }}
                               @else
                                   {{ route('person.order.show', $order) }}
                               @endadmin
                                   ">@lang('order.open')</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
@endsection
