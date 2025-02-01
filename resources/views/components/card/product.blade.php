<div class="card" style="width: 100%;">
    <img height="230" src="{{ url('storage', $product->image) }}" class="card-img-top" alt="" style="object-fit: cover; object-position: center;">
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text">{{ $product->description }}</p>
        <div style="width: 20px; height: 20px; border-radius: 50%; background-color: {{ $product->color }}"></div>
        <p>{{ $product->price }}</p>
        <p>{{ $product->brand->name }} </p>
        <p>{{ $product->weight }}</p>
        <p>{{ $product->material }}</p>
        <a href="{{ route('product.detail', $product->slug) }}" class="btn btn-primary">{{ __('Перейти к товару') }}</a>
    </div>
</div>
