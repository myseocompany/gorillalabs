@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Lista de Customers</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach($customers as $customer)
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-xl font-semibold">{{ $customer->name }}</h2>
                <p class="text-gray-600">{{ $customer->phone }}</p>
                <p class="text-gray-600">{{ $customer->email }}</p>
                <div class="mt-4 flex justify-between">
                    <a href="tel:{{ $customer->phone }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700" target="_blank">Llamar</a>
                    <a href="https://wa.me/57{{ $customer->phone }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700" target="_blank">WhatsApp</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $customers->links() }}
    </div>
</div>
@endsection