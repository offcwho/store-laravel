<x-app.layout>
    <x-slot:title>{{ $titlePage }}</x-slot:title>
    <h1>Брендs</h1>
    <livewire:product.product-list :products="$products" />
</x-app.layout>
