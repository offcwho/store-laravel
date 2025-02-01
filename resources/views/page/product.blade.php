<x-app.layout>
    <x-slot:title>{{ $titlePage }}</x-slot:title>
    <h1>{{ $product->title }}</h1>
    <img src="{{ url('storage', $product->image) }}" alt="">
    <p>{{ $product->description }}</p>
    <div style="width: 20px; height: 20px; border-radius: 50%; background-color: {{ $product->color }}"></div>
    <p>{{ $product->price }} ₽</p>
    <p>{{ $product->brand->name }} </p>
    <p>{{ $product->weight }}</p>
    <p>{{ $product->material }}</p>
</x-app.layout>
