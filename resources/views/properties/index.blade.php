@extends('layouts.app')

@section('content')
<div class="bg-slate-50 py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-slate-800">Properties in <span class="text-indigo-600">{{ $searchCity }}</span></h1>
        <p class="text-slate-600 mt-2">Found {{ $properties->total() }} properties matching your search.</p>

        @if($properties->isEmpty())
            <div class="text-center bg-white p-10 rounded-xl mt-8">
                <p class="text-slate-500">Sorry, no properties were found in "{{ $searchCity }}". Try another search.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
                @foreach ($properties as $property)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col">
                        <div class="h-48 bg-gray-200"></div> <div class="p-6 flex-grow flex flex-col">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $property->name }}</h3>
                            <p class="text-sm text-slate-500 mt-1">{{ $property->address }}</p>
                            <p class="text-lg font-bold text-indigo-600 mt-4">{{ $property->rooms_count }} available room(s)</p>
                            <div class="mt-auto pt-4">
                                <a href="{{ route('properties.show', $property) }}" class="block text-center bg-indigo-500 text-white font-semibold py-2 rounded-lg hover:bg-indigo-600 transition">
                                    View Rooms
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $properties->links() }} </div>
        @endif
    </div>
</div>
@endsection
        