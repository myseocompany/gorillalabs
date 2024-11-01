@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Lista de Customers</h1>
    <div class="space-y-4">
        @foreach($customers as $customer)
            <div class="bg-white shadow-md rounded-lg p-4 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold">{{ $customer->name }}</h2>
                    <p class="text-gray-600">{{ $customer->phone }}</p>
                    <p class="text-gray-600">{{ $customer->email }}</p>
                </div>
                <div class="flex space-x-4">
                    <a href="tel:{{ $customer->phone }}" class="text-blue-500 hover:text-blue-700" target="_blank">
                        <i class="fas fa-phone-alt fa-2x"></i>
                    </a>
                    <a href="https://wa.me/57{{ $customer->phone }}" class="text-green-500 hover:text-green-700" target="_blank">
                        <i class="fab fa-whatsapp fa-2x"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $customers->links() }}
    </div>
</div>
@endsection