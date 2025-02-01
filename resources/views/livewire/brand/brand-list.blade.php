<div class="container text-center">
    <div class="row">
        @foreach ($brands as $brand)
        <div class="col">
            <x-card.brand :brand="$brand" />
        </div>
        @endforeach
    </div>
</div>
