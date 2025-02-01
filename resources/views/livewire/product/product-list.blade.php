<div class="container text-center">
    <div class="row">
        @foreach ($products as $product)
        <div class="col">
            <x-card.product :product="$product" />
        </div>
        @endforeach
    </div>
</div>
