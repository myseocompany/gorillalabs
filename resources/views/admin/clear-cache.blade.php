<form action="{{ url('/clear-cache') }}" method="POST">
    @csrf
    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Limpiar Caché</button>
</form>