<p>Привет!</p>
<p>{{$product->__('name')}} есть в наличае, спеши заказать</p>
<a href="{{ route('product', [$product->category->code, $product->code]) }}"></a>

