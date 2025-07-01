@extends('layouts.app')

@section('content')
<div class="bg-slate-50 py-12">
    <div class="container mx-auto px-4">
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
                                    $imagePath = $room->images->first()->path ?? null;
                                @endphp
                                @if($imagePath)
                                    <img src="{{ asset('storage/' . $imagePath) }}" alt="Room Image" class="w-40 h-28 object-cover rounded-md">
                                @else
                                    <div class="w-40 h-28 bg-gray-200 rounded-md flex items-center justify-center text-xs text-gray-400">No Image</div>
                                @endif
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
@endsection