@extends('layouts.app')

@section('content')
<div class="bg-slate-50 py-12">
    <div class="container mx-auto px-4">
        <a href="{{ url('/') }}" class="text-sm text-indigo-600 hover:underline">&larr; Back</a>
        <h1 class="text-4xl font-bold text-slate-800">{{ $property->name }}</h1>
        <p class="text-lg text-slate-600 mt-2">{{ $property->address }}, {{ $property->city }}</p>
        <p class="text-slate-500 mt-4">{{ $property->description }}</p>
        
        <hr class="my-8">

        <h2 class="text-2xl font-semibold text-slate-700 mb-6">Available Rooms</h2>

        <div class="bg-white rounded-xl shadow-md overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 border-b">
                    <tr>
                        <th class="p-4 font-semibold">Room</th>
                        <th class="p-4 font-semibold">Details</th>
                        <th class="p-4 font-semibold">Rent</th>
                        <th class="p-4 font-semibold">Agent</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($property->rooms as $room)
                        <tr class="border-b hover:bg-slate-50">
                            <td class="p-4 align-top">
                                @php
                                    // Get all image paths for the current room
                                    $imagePaths = $room->images->pluck('path')->toArray();
                                @endphp

                                {{-- Image Gallery Container --}}
                                <div class="room-gallery-container relative w-40 h-28" 
                                    data-images="{{ json_encode($imagePaths) }}" 
                                    data-current-index="0">

                                    @if (!empty($imagePaths))
                                        {{-- Main Image Display --}}
                                        <img src="{{ asset('storage/' . $imagePaths[0]) }}" alt="Room Image" class="room-image w-full h-full object-cover rounded-md">

                                        {{-- Arrows - only show if there is more than 1 image --}}
                                        @if (count($imagePaths) > 1)
                                            <button class="gallery-arrow prev-btn absolute top-1/2 left-1 transform -translate-y-1/2 bg-black bg-opacity-40 text-white rounded-full p-1 hover:bg-opacity-60">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"></path></svg>
                                            </button>
                                            <button class="gallery-arrow next-btn absolute top-1/2 right-1 transform -translate-y-1/2 bg-black bg-opacity-40 text-white rounded-full p-1 hover:bg-opacity-60">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg>
                                            </button>
                                        @endif

                                    @else
                                        {{-- Placeholder for when there are no images --}}
                                        <div class="w-full h-full bg-slate-200 rounded-md flex items-center justify-center text-xs text-slate-400">No Image</div>
                                    @endif
                                </div>
                            </td>
                            <td class="p-4 align-top">
                                <p class="font-bold text-base text-slate-800">Room #{{ $room->room_number }}</p>
                                <p class="text-slate-600 whitespace-normal mt-1">{{ $room->description }}</p>
                                <p class="text-xs text-slate-500 mt-2">Capacity: {{ $room->capacity }} Person(s)</p>
                            </td>
                            <td class="p-4 align-top">
                                <p class="font-semibold text-indigo-600">KES {{ number_format($room->rent, 2) }}/month</p>
                            </td>
                            <td class="p-4 align-top">
                                <p class="font-semibold text-slate-800">{{ $room->agent->user->name ?? 'N/A' }}</p>
                                <p class="text-slate-600">{{ $room->agent->phone_number ?? 'N/A' }}</p>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-6 text-center text-slate-500">There are no available rooms in this property at the moment.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('click', function(event) {
    const target = event.target.closest('.gallery-arrow');

    if (!target) {
        return; // Exit if the click wasn't on a gallery arrow
    }

    const galleryContainer = target.closest('.room-gallery-container');
    const imageElement = galleryContainer.querySelector('.room-image');
    
    // Get image data from the container's data attributes
    const images = JSON.parse(galleryContainer.dataset.images);
    let currentIndex = parseInt(galleryContainer.dataset.currentIndex, 10);
    const totalImages = images.length;

    // Determine direction and update the index
    if (target.classList.contains('next-btn')) {
        currentIndex = (currentIndex + 1) % totalImages;
    } else if (target.classList.contains('prev-btn')) {
        currentIndex = (currentIndex - 1 + totalImages) % totalImages;
    }

    // Update the image source and the data attribute
    imageElement.src = `{{ asset('storage') }}/${images[currentIndex]}`;
    galleryContainer.dataset.currentIndex = currentIndex;
});
</script>
@endsection