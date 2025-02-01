<div class="card" style="width: 100%;">
    <img height="230" src="{{ url('storage', $brand->image) }}" class="card-img-top" alt="" style="object-fit: cover; object-position: center;">
    <div class="card-body">
        <h5 class="card-title">{{ $brand->name }}</h5>
        <p class="card-text"></p>
        <a href="{{ route('brand.showBrand', $brand->id) }}" class="btn btn-primary">{{ __('Перейти к бренду') }}</a>
    </div>
</div>
