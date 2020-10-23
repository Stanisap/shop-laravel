<p>Привет!</p>
<p>{{$sku->__('name')}} есть в наличае, спеши заказать</p>
<a href="{{ route('product', [$sku->product->category->code, $sku->product->code]) }}"></a>

