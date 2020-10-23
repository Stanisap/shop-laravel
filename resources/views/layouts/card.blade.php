<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">

            @if($sku->product->isNew())<span class="badge badge-success">Новинка</span>@endif
            @if($sku->product->isHit())<span class="badge badge-warning">Хит продаж</span>@endif
            @if($sku->product->isRecommend())<span class="badge badge-danger">Рекомендуемые</span>@endif
        </div>

        <img src="{{ Storage::url($sku->product->image) }}" alt="{{ $sku->product->__('name') }}" >
        <div class="caption">
            <h3>{{ $sku->product->__('name') }}</h3>
            @isset($sku->product->properties)

                @foreach($sku->propertyOptions as $propertyOption)

                    <h4>{{ $propertyOption->property->__('name') }}: {{ $propertyOption->__('name') }}</h4>
                @endforeach

            @endisset

            <p>{{ $sku->price . ' ' . $currencySymbol }} </p>
            <p>
                {{ isset($category) ? $category->__('name') : $sku->product->category->__('name') }}
                <form action="{{ route('basket-add', $sku) }}" method="POST">
                    @if($sku->isAvailable())
                    <button type="submit" class="btn btn-primary" role="button">@lang('main.to_cart')</button>
                    @else
                        @lang('main.product_not_available')
                    @endif
                    <a href="{{ route('sku', [isset($category) ? $category->code : $sku->product->category->code, $sku->product->code, $sku->id]) }}"
                       class="btn btn-default"
                       role="button">@lang('main.see_more')</a>
                    @csrf
                </form>
            </p>
        </div>
    </div>
</div>

