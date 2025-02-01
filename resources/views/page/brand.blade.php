<x-app.layout>
    <x-slot:title>{{ $titlePage }}</x-slot:title>
    <h1>Это страница категорий</h1>
    <livewire:brand.brand-list :brands="$brands"/>
</x-app.layout>
