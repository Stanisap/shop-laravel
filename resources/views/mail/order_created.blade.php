<p>Привет {{ $name }}</p>
<p>Ваш заказ на сумму {{ $fullSum }} {{$currencySymbol}} принят</p>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Название</th>
        <th>Кол-во</th>
        <th>Цена</th>
        <th>Стоимость</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->skus as $sku)
        <tr>
            <td>
                <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code, $sku]) }}">
                    <img height="56px" src="{{ Storage::url($sku->product->image) }}">
                    {{ $sku->product->__('name') }}
                </a>
            </td>
            <td><span class="badge">{{ $sku->countInOrder }}</span>

            </td>
            <td>{{ $sku->price }} {{$currencySymbol}}</td>
            <td>{{ $sku->price * $sku->countInOrder }} {{$currencySymbol}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
