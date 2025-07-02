@extends('layouts.app')

@section('content')
<div class="bg-slate-50 py-12">
    <div class="container mx-auto px-4">
        
        {{-- Property Header --}}
        <div class="mb-8">
            <a href="{{ route('properties.show', $property) }}" class="text-sm text-indigo-600 hover:underline">&larr; Back to Property Details</a>
            <h1 class="text-3xl font-bold text-slate-800 mt-2">Reviews for <span class="text-indigo-600">{{ $property->name }}</span></h1>
            <p class="text-slate-600 mt-1">{{ $property->address }}, {{ $property->city }}</p>
        </div>

        {{-- Reviews Section --}}
        <div id="reviews">
            @if($reviews->isNotEmpty())
                <div class="space-y-6">
                    @foreach($reviews as $review)
                        <div class="p-6 border rounded-xl bg-white shadow-sm">
                            <div class="flex items-start justify-between">
                                {{-- Reviewer Info and Rating --}}
                                <div>
                                    <p class="font-semibold text-slate-800">{{ $review->booking->student->user->name ?? 'Anonymous' }}</p>
                                    <div class="flex items-center mt-1">
                                        {{-- Star Rating --}}
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="h-5 w-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-slate-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                {{-- Date Created --}}
                                <p class="text-xs text-slate-500">{{ $review->created_at->format('M d, Y') }}</p>
                            </div>

                            {{-- Comment --}}
                            <p class="text-slate-600 mt-4 whitespace-pre-wrap">{{ $review->description }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Message for when there are no reviews --}}
                <div class="text-center bg-white p-10 rounded-xl mt-8">
                    <p class="text-slate-500">This property has no reviews yet.</p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection