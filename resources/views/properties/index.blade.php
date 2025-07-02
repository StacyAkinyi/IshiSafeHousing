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
                        
                             @if($property->image)
                                    <img src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->name }}" class="w-full h-40 object-cover">
                                @else
                                    {{-- Fallback placeholder if no image is set --}}
                                    <div class="w-full h-40 bg-slate-200 flex items-center justify-center">
                                        <span class="text-slate-400 text-xs">No Image</span>
                                    </div>
                                @endif
                         <div class="p-6 flex-grow flex flex-col">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $property->name }}</h3>
                            <p class="text-sm text-slate-500 mt-1">{{ $property->address }}</p>
                            <div class="flex items-center my-3">
                                @if ($property->reviews_count > 0)
                                    <div class="flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="h-5 w-5 {{ $i <= round($property->reviews_avg_rating) ? 'text-yellow-400' : 'text-slate-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        @endfor
                                    </div>
                                    <p class="text-xs text-slate-500 ml-2">
                                        {{ number_format($property->reviews_avg_rating, 1) }} 
                                        <a href="{{ route('properties.reviews', $property) }}" class="hover:underline">
                                            ({{ $property->reviews_count }} {{ Str::plural('review', $property->reviews_count) }})
                                        </a>
                                    </p>
                                @else
                                    <p class="text-xs text-slate-500">No reviews yet</p>
                                @endif
                            </div>
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
        