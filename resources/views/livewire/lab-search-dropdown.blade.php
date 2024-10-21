<div class="relative">
    @if(!empty($results))
        <ul class="absolute left-0 w-full bg-white border border-gray-300 rounded-lg mt-2">
            @foreach($results as $result)
                <li class="px-4 py-2 hover:bg-gray-200">{{ $result->name }}</li>
            @endforeach
        </ul>
    @endif
</div>
