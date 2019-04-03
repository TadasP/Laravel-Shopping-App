<div class="row">
@foreach($productsIds as $product)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            @if ($product->product == null)
            <a href="{{ route('frontproducts.show', $product->id) }}">
                <img class="card-img-top product-img" src="{{$product->img}}" alt="{{$product->name}}">
            </a>
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('frontproducts.show', $product->id) }}">{{$product->name}}</a>
                </h4>
                <h5>€{{$product->price}}</h5>
                <p class="card-text">
                    {{ str_limit($product->description, $limit = 50, $end = '...') }}
                </p>
            </div>
            @else
            <a href="{{ route('frontproducts.show', $product->product->id) }}">
                <img class="card-img-top product-img" src="{{$product->product->img}}" alt="{{$product->product->name}}">
            </a>
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('frontproducts.show', $product->product->id) }}">{{$product->product->name}}</a>
                </h4>
                <h5>€{{$product->product->price}}</h5>
                <p class="card-text">
                        {{ str_limit($product->product->description, $limit = 50, $end = '...') }}
                </p>
            </div>
            @endif
            <div class="card-footer">
            </div>
        </div>
    </div>
@endforeach
</div>
<div class="row">
    <div style="margin:auto;">
        {{ $productsIds->links()}}
    </div>
</div>

