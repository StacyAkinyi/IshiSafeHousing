<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - IshiSafeHousing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link.active { background-color: #4f46e5; color: white; }
    </style>
</head>
<body class="bg-slate-100">

<div class="flex min-h-screen">
    <aside class="w-64 flex-shrink-0 bg-slate-800 text-slate-200 flex flex-col">
        <div class="h-20 flex items-center justify-center bg-slate-900 shadow-md">
            <h1 class="text-2xl font-bold text-white tracking-wider">IshiSafe<span class="text-indigo-400">Housing</span></h1>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="account">
                <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                My Account
            </a>
            <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="properties">
                <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Available Properties
            </a>
            <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="bookings">
                <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                My Bookings
            </a>
            <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="reviews">
               <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                My Reviews
            </a>

        </nav>

        <div class="px-4 py-6">
             <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="w-full text-left flex items-center py-3 px-4 rounded-lg text-red-300 transition duration-200 hover:bg-red-500 hover:text-white">
                    <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 p-6 lg:p-10">
        <div id="account" class="content-section">
            <h2 class="text-3xl font-semibold text-slate-700 mb-6">My Account</h2>
            @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="space-y-8">

        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-semibold text-slate-700">Personal Details</h3>
                <button data-modal-target="personalDetailsModal" class="text-sm bg-indigo-100 text-indigo-700 font-semibold py-2 px-4 rounded-lg hover:bg-indigo-200 transition">
                    Edit Details
                </button>
            </div>
            <div class="space-y-3 text-slate-600">
                <div class="flex">
                    <p class="w-1/3 font-medium text-slate-500">Full Name</p>
                    <p class="w-2/3">{{ $student->full_name ?? 'Add your full name here' }}</p>
                </div>
                <div class="flex">
                    <p class="w-1/3 font-medium text-slate-500">Email Address</p>
                    <p class="w-2/3">{{ $student->user->email }}</p>
                </div>
                <div class="flex">
                    <p class="w-1/3 font-medium text-slate-500">Phone Number</p>
                    <p class="w-2/3">{{ $student->phone_number ?? 'Not provided' }}</p>
                </div>
                

            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            @if ($student->nextOfKin)
                {{-- This shows if a Next of Kin EXISTS --}}
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-semibold text-slate-700">Next of Kin Details</h3>
                    <button data-modal-target="nextOfKinModal" class="text-sm bg-indigo-100 text-indigo-700 font-semibold py-2 px-4 rounded-lg hover:bg-indigo-200 transition">
                        Update Details
                    </button>
                </div>
                <div class="space-y-3 text-slate-600">
                    <div class="flex">
                        <p class="w-1/3 font-medium text-slate-500">Full Name</p>
                        <p class="w-2/3">{{ $student->nextOfKin->name }}</p>
                    </div>
                    <div class="flex">
                        <p class="w-1/3 font-medium text-slate-500">Relationship</p>
                        <p class="w-2/3">{{ $student->nextOfKin->relationship }}</p>
                    </div>
                    <div class="flex">
                        <p class="w-1/3 font-medium text-slate-500">Phone Number</p>
                        <p class="w-2/3">{{ $student->nextOfKin->phone_number }}</p>
                    </div>
                     <div class="flex">
                        <p class="w-1/3 font-medium text-slate-500">Email Address</p>
                        <p class="w-2/3">{{ $student->nextOfKin->email ?? 'N/A' }}</p>
                    </div>
                    <div class="flex">
                        <p class="w-1/3 font-medium text-slate-500">ID Number</p>
                        <p class="w-2/3">{{ $student->nextOfKin->id_number }}</p>
                    </div>
                </div>
            @else
                {{-- This shows if a Next of Kin DOES NOT exist --}}
                <div class="text-center">
                    <h3 class="text-2xl font-semibold text-slate-700 mb-2">Next of Kin</h3>
                    <p class="text-slate-500 mb-4">You have not added a next of kin yet.</p>
                    <button data-modal-target="nextOfKinModal" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 transition">
                        Add Next of Kin
                    </button>
                </div>
            @endif
        </div>

    </div>
</div>

<div id="personalDetailsModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-md">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-semibold text-slate-700">Edit Personal Details</h3>
            <button data-modal-hide="personalDetailsModal" class="text-slate-500 hover:text-slate-800">&times;</button>
        </div>
            <form action="{{ route('student.account.updateDetails') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="full_name" class="block text-sm font-medium text-slate-600">Full Name</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $student->full_name ?? $student->user->name) }}" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md ...">
                    @error('full_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-600">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $student->user->email) }}" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md ...">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="phone_number" class="block text-sm font-medium text-slate-600">Phone Number</label>
                    <input type="tel" name="phone_number" value="{{ old('phone_number', $student->phone_number) }}" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md ...">
                    @error('phone_number')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md ...">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<div id="nextOfKinModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-md">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-semibold text-slate-700">Next of Kin Details</h3>
            <button data-modal-hide="nextOfKinModal" class="text-slate-500 hover:text-slate-800">&times;</button>
        </div>
        <form action="{{ route('student.account.updateNextOfKin') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="kin_name" class="block text-sm font-medium text-slate-600">Full Name</label>
                    <input type="text" name="kin_name" value="{{ old('kin_name', $student->nextOfKin->name ?? '') }}" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500">
                </div>
                <div>
                    <label for="kin_relationship" class="block text-sm font-medium text-slate-600">Relationship</label>
                    <input type="text" name="kin_relationship" value="{{ old('kin_relationship', $student->nextOfKin->relationship ?? '') }}" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500">
                </div>
                <div>
                    <label for="kin_id_number" class="block text-sm font-medium text-slate-600">ID Number (Optional)</label>
                    <input type="text" name="kin_id_number" value="{{ old('kin_id_number', $student->nextOfKin->id_number ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500">
                </div>
                <div>
                    <label for="kin_phone_number" class="block text-sm font-medium text-slate-600">Phone Number</label>
                    <input type="tel" name="kin_phone_number" value="{{ old('kin_phone_number', $student->nextOfKin->phone_number ?? '') }}" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500">
                </div>
                <div>
                    <label for="kin_email" class="block text-sm font-medium text-slate-600">Email Address (Optional)</label>
                    <input type="email" name="kin_email" value="{{ old('kin_email', $student->nextOfKin->email ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Save Next of Kin</button>
            </div>
        </form>
    </div>


        </div>

        <div id="properties" class="content-section hidden">
            <h2 class="text-3xl font-semibold text-slate-700 mb-6">Available Properties</h2>
            
            <div class="mb-6">
                <input 
                    type="text" 
                    id="propertySearch" 
                    placeholder="Search by city..." 
                    class="w-full md:w-1/2 px-4 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div id="propertyGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($availableProperties as $property)
                    <div class="property-card bg-white rounded-xl shadow-md overflow-hidden" data-city="{{ strtolower($property->city) }}">
                        
                                  @if($property->image)
                                        <img src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->name }}" class="w-full h-40 object-cover">
                                    @else
                                        {{-- Fallback placeholder if no image is set --}}
                                        <div class="w-full h-40 bg-slate-200 flex items-center justify-center">
                                            <span class="text-slate-400 text-xs">No Image</span>
                                        </div>
                                    @endif
                         <div class="p-4 flex flex-col">
                            <div class="flex-grow">
                                <h3 class="font-semibold text-lg">{{ $property->name }}</h3>
                                <p class="text-sm text-slate-600">{{ $property->city }}</p>
                                 
                                <p class="text-sm text-slate-800 mt-2 font-bold">{{ $property->rooms_count }} available room(s)</p>
                            </div>
                            <div class="mt-4">
                                <button type="button" 
                                        data-property-id="{{ $property->id }}"
                                        class="view-details-btn text-indigo-600 hover:underline font-semibold">
                                    View Details & Rooms
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-600 md:col-span-3">No available properties at the moment. Please check back later.</p>
                @endforelse
            </div>
        </div>


        <div id="propertyDetailsModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50 p-4">
    <div class="bg-white p-6 md:p-8 rounded-xl shadow-2xl w-full max-w-3xl flex flex-col max-h-[90vh]">
        <!-- Modal Header -->
        <div class="flex justify-between items-center mb-4 border-b pb-4">
            <h3 id="modalPropertyName" class="text-2xl font-semibold text-slate-800">Property Details</h3>
            <button data-modal-hide="propertyDetailsModal" class="text-3xl font-bold leading-none hover:text-red-600">&times;</button>
        </div>

        <!-- Modal Content (Scrollable Area) -->
        <div class="flex-1 overflow-y-auto pr-2">
            
            <!-- Section 1: Available Rooms -->
            <div>
                <h4 class="text-xl font-bold mb-3 text-slate-700">Available Rooms</h4>
                <div id="modalRoomList" class="space-y-4">
                    <!-- Room list will be dynamically inserted here by JavaScript -->
                    <p class="text-slate-500">Loading rooms...</p>
                </div>
            </div>

            <!-- Separator Line -->
            <hr class="my-8">

            <!-- Section 2: Make a Booking -->
            <div>
                <h4 class="text-xl font-bold mb-3 text-slate-700">Make a Booking</h4>
                <div class="bg-slate-50 p-6 rounded-lg">
                    @if(session('availability_error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Booking Failed!</strong>
                            <span class="block sm:inline">{{ session('availability_error') }}</span>
                        </div>
                    @endif
                    <p id="bookingInstructions" class="text-sm text-slate-600 mb-4">Please select a room from the list above to make a booking request.</p>
                    <form id="bookingForm" action="{{ route('student.bookings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" id="bookingRoomId">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-slate-700">Start Date</label>
                                <input type="date" name="start_date" id="start_date" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-slate-700">End Date</label>
                                <input type="date" name="end_date" id="end_date" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md">
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" id="bookingSubmitBtn" disabled class="w-full bg-indigo-400 cursor-not-allowed text-white py-2 px-4 rounded-md">
                                Select a Room First
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

        <div id="bookings" class="content-section hidden">
            <h2 class="text-3xl font-semibold text-slate-700 mb-6">My Bookings</h2>
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <table class="min-w-full text-left">
                    <thead class="bg-slate-50 border-b">
                        <tr>
                            <th class="p-4 text-sm font-semibold text-slate-600">Property</th>
                            <th class="p-4 text-sm font-semibold text-slate-600">Room #</th>
                            <th class="p-4 text-sm font-semibold text-slate-600">Status</th>
                            <th class="p-4 text-sm font-semibold text-slate-600">Booking Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($myBookings as $booking)
                            <tr class="border-b hover:bg-slate-50">
                                <td class="p-4 text-slate-800">{{ $booking->room->property->name ?? 'N/A' }}</td>
                                <td class="p-4 text-slate-600">{{ $booking->room->room_number ?? 'N/A' }}</td>
                                <td class="p-4 text-slate-600">{{ ucfirst($booking->status) }}</td>
                                <td class="p-4 text-slate-600">{{ $booking->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="p-4 text-center text-slate-500">You have not made any bookings yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

<div id="reviews" class="content-section hidden">
    <h2 class="text-3xl font-semibold text-slate-700 mb-6">My Reviews</h2>

    <div class="mb-10">
        <h3 class="text-xl font-bold text-slate-800 mb-4 border-b pb-2">Bookings to Review</h3>
        <div class="space-y-3">
            @forelse ($reviewableBookings as $booking)
                <div class="bg-white p-4 rounded-xl shadow-sm flex justify-between items-center">
                    <div>
                        <p class="font-semibold">{{ $booking->room->property->name ?? 'N/A' }} - Room #{{ $booking->room->room_number ?? 'N/A' }}</p>
                        <p class="text-sm text-slate-500">Stay Completed: {{ $booking->end_date->format('M d, Y') }}</p>
                    </div>
                    <button type="button" 
                            data-modal-target="reviewModal" 
                            data-booking-id="{{ $booking->id }}"
                            class="write-review-btn bg-indigo-600 text-white font-semibold text-sm py-2 px-4 rounded-lg hover:bg-indigo-700">
                        Write a Review
                    </button>
                </div>
            @empty
                <p class="text-slate-600 p-4">You have no new bookings to review.</p>
            @endforelse
        </div>
    </div>

    <div>
        <h3 class="text-xl font-bold text-slate-800 mb-4 border-b pb-2">Your Past Reviews</h3>
        <div class="space-y-3">
            @forelse ($myReviews as $review)
                <div class="bg-white p-4 rounded-xl shadow-sm">
                    <p class="font-semibold">{{ $review->booking->room->property->name ?? 'N/A' }} - Room #{{ $review->booking->room->room_number ?? 'N/A' }}</p>
                    <div class="flex items-center my-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="h-5 w-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-slate-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                        <span class="text-xs text-slate-500 ml-2">({{ $review->created_at->diffForHumans() }})</span>
                    </div>
                    <p class="text-slate-600 italic">"{{ $review->description }}"</p>
                </div>
            @empty
                <p class="text-slate-600 p-4">You have not written any reviews yet.</p>
            @endforelse
        </div>
    </div>
</div>

<div id="reviewModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50 p-4">
    <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-lg">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold">Write Your Review</h3>
            <button data-modal-hide="reviewModal" class="text-2xl font-bold">&times;</button>
        </div>
        <form action="{{ route('student.reviews.store') }}" method="POST">
            @csrf
            <input type="hidden" name="booking_id" id="reviewBookingId">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Your Rating</label>
                    <div class="flex items-center space-x-1 rating-stars">
                        @for ($i = 1; $i <= 5; $i++)
                        <label for="rating{{$i}}" class="cursor-pointer">
                            <input type="radio" name="rating" id="rating{{$i}}" value="{{$i}}" class="sr-only" required>
                            <svg class="w-8 h-8 text-slate-300 transition-colors" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        </label>
                        @endfor
                    </div>
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700">Your Comments</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md"></textarea>
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Submit Review</button>
            </div>
        </form>
    </div>
</div>

           
    </main>
</div>

<footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <p>© {{ date('Y') }} Ishi Safe Housing. All rights reserved.</p>
        </div>
    </footer>

<script>
    const storageUrl = "{{ asset('storage/') }}"; 
     function initStudentMap() {
        const mapTabLink = document.querySelector('.sidebar-link[data-target="maps"]');
        const mapContainer = document.getElementById("student-map");
        let studentMap = null; // Variable to hold the map instance

        // Listen for a click on the "Maps" tab
        mapTabLink.addEventListener('click', function() {
            // Only create the map the VERY FIRST time the tab is clicked
            if (!studentMap && mapContainer) {
                console.log("Initializing Student Map now...");

                const mapCenter = { lat: -1.2921, lng: 36.8219 };
                studentMap = new google.maps.Map(mapContainer, {
                    zoom: 12,
                    center: mapCenter,
                });
                const infoWindow = new google.maps.InfoWindow();

                studentMapProperties.forEach(property => {
                    if (property.latitude && property.longitude) {
                        const position = {
                            lat: parseFloat(property.latitude),
                            lng: parseFloat(property.longitude)
                        };
                        const marker = new google.maps.Marker({ position, map: studentMap, title: property.name });

                        marker.addListener('click', () => {
                            infoWindow.setContent(`<div class="p-2 font-sans"><p class="font-bold">${property.name}</p></div>`);
                            infoWindow.open(studentMap, marker);
                        });
                    }
                });
            }
        });
    }
    document.addEventListener('DOMContentLoaded', function () {

    // ===================================================================
    // 1. SETUP - Get all necessary elements from the page once.
    // ===================================================================
        const elements = {
            // Elements for sidebar and sections
            sidebarLinks: document.querySelectorAll('.sidebar-link'),
            contentSections: document.querySelectorAll('.content-section'),
            
            // Elements for ALL modals
            modalTriggers: document.querySelectorAll('[data-modal-target]'),
            modalHideButtons: document.querySelectorAll('[data-modal-hide]'),

            // Specific elements for the property details modal
            propertyDetailsModal: document.getElementById('propertyDetailsModal'),
            propertyNameEl: document.getElementById('modalPropertyName'),
            roomListEl: document.getElementById('modalRoomList'),
            bookingForm: document.getElementById('bookingForm'),
            bookingRoomIdInput: document.getElementById('bookingRoomId'),
            bookingSubmitBtn: document.getElementById('bookingSubmitBtn'),
            bookingInstructions: document.getElementById('bookingInstructions'),
            viewDetailsButtons: document.querySelectorAll('.view-details-btn'),

        };
        const reviewModal = document.getElementById('reviewModal');
        if (reviewModal) {
            const reviewBookingIdInput = reviewModal.querySelector('#reviewBookingId');
            const writeReviewButtons = document.querySelectorAll('.write-review-btn');

            writeReviewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const bookingId = this.dataset.bookingId;
                    reviewBookingIdInput.value = bookingId;
                    reviewModal.classList.remove('hidden');
                });
            });

            // Star Rating interactivity
            const ratingStarsContainer = reviewModal.querySelector('.rating-stars');
            if(ratingStarsContainer) {
                const stars = ratingStarsContainer.querySelectorAll('svg');
                ratingStarsContainer.addEventListener('change', event => {
                    const starValue = event.target.value;
                    if (!starValue) return;

                    stars.forEach((star, index) => {
                        star.classList.toggle('text-yellow-400', index < starValue);
                        star.classList.toggle('text-slate-300', index >= starValue);
                    });
                });
            }
        }

        const ratingStarsContainer = document.querySelector('.rating-stars');
            if (ratingStarsContainer) {
                const stars = ratingStarsContainer.querySelectorAll('svg');
                ratingStarsContainer.addEventListener('change', event => {
                    const starValue = event.target.value;
                    if (!starValue) return;
                    stars.forEach((star, index) => {
                        star.classList.toggle('text-yellow-400', index < starValue);
                        star.classList.toggle('text-slate-300', index >= starValue);
                    });
                });
            }

        // ===================================================================
        // 2. EVENT LISTENERS (This section is now fixed and unified)
        // ===================================================================

        // --- Sidebar Navigation ---
        elements.sidebarLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-target');
                setActiveLink(targetId);
                showSection(targetId);
            });
        });
        
        // --- ALL MODAL TRIGGERS ---
        // This single block now handles ALL buttons that open a modal.
        elements.modalTriggers.forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.dataset.modalTarget;
                const modal = document.getElementById(modalId);

                // Check if it's the special 'View Details' button that needs to fetch data
                if (this.classList.contains('view-details-btn')) {
                    const propertyId = this.dataset.propertyId;
                    openModalForProperty(propertyId);
                } 
                // For all other simple modals (like "Edit Details"), just show them
                else if (modal) {
                    modal.classList.remove('hidden');
                }
            });
        });
        
        // --- General Modal Close Buttons ---
        elements.modalHideButtons.forEach(button => {
            button.addEventListener('click', () => {
                const modalToHide = button.closest('.fixed.inset-0');
                if(modalToHide) modalToHide.classList.add('hidden');
            });
        });
         elements.viewDetailsButtons.forEach(button => {
        button.addEventListener('click', function() {
            const propertyId = this.dataset.propertyId;
            openModalForProperty(propertyId);
        });
    });

        // ===================================================================
        // 3. FUNCTIONS (These are the same as before)
        // ===================================================================

        function showSection(targetId) {
            elements.contentSections.forEach(section => section.classList.add('hidden'));
            const targetSection = document.getElementById(targetId);
            if (targetSection) targetSection.classList.remove('hidden');
        }

        function setActiveLink(targetId) {
            elements.sidebarLinks.forEach(link => link.classList.remove('active'));
            const newActiveLink = document.querySelector(`.sidebar-link[data-target="${targetId}"]`);
            if (newActiveLink) newActiveLink.classList.add('active');
        }

        async function openModalForProperty(propertyId) {
            resetBookingForm();
            elements.propertyNameEl.textContent = 'Loading...';
            elements.roomListEl.innerHTML = '<p class="text-slate-500">Fetching available rooms...</p>';
            elements.propertyDetailsModal.classList.remove('hidden');

            try {
                const response = await fetch(`/student/properties/${propertyId}/rooms`);
                if (!response.ok) throw new Error('Failed to fetch rooms.');
                const data = await response.json();

                elements.propertyNameEl.textContent = data.property_name;
                elements.roomListEl.innerHTML = ''; 

                if (data.rooms && data.rooms.length > 0) {
                    data.rooms.forEach(room => {
                        const roomDiv = document.createElement('div');
                        roomDiv.className = 'p-4 border rounded-lg';
                        const rentValue = parseFloat(room.rent);
                        const displayRent = !isNaN(rentValue) ? `KES ${rentValue.toLocaleString()}/month` : 'N/A';
                        const imagePaths = room.images.map(img => `${storageUrl}/${img.path}`);
                        const mainImage = imagePaths.length > 0 ? imagePaths[0] : 'path/to/default-image.jpg';
                        const agentName = room.agent?.user?.name || 'Not specified';
                        const agentPhone = room.agent?.phone_number || 'Not available';

                        roomDiv.innerHTML = `
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="room-gallery-container md:col-span-1 relative">
                                <div class="md:col-span-1"><img src="${mainImage}" alt="Room Image" class="room-image w-full h-40 object-cover rounded-md border"></div>
                                <div class="image-data hidden" 
                                        data-images='${JSON.stringify(imagePaths)}' 
                                        data-current-index="0">
                                    </div>

                                    ${imagePaths.length > 1 ? `
                                        <button class="gallery-arrow prev-btn absolute top-1/2 left-2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-1 hover:bg-opacity-75 focus:outline-none">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                        </button>
                                        <button class="gallery-arrow next-btn absolute top-1/2 right-2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-1 hover:bg-opacity-75 focus:outline-none">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </button>
                                    ` : ''}
                                </div>
                                <div class="md:col-span-2 flex flex-col">
                                    <div class="flex justify-between items-start mb-2">
                                        <h5 class="text-lg font-bold text-slate-800">Room #${room.room_number}</h5>
                                        <button class="book-room-btn text-sm bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700" data-room-id="${room.id}" data-room-number="${room.room_number}">Select to Book</button>
                                    </div>
                                    <div class="flex-grow"><p class="text-sm text-slate-600 mb-3">${room.description || 'No description.'}</p></div>
                                    <div class="grid grid-cols-2 gap-4 pt-3 border-t text-sm">
                                        <div><p class="text-xs font-bold uppercase">Rent</p><p class="font-semibold">${displayRent}</p></div>
                                        <div><p class="text-xs font-bold uppercase">Capacity</p><p class="font-semibold">${room.capacity} Person(s)</p></div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-3 border-t md:col-span-3">
                                <p class="text-xs font-bold text-slate-500 uppercase mb-1">Contact Agent</p>
                                <div class="flex items-center text-sm">
                                    <p class="font-semibold text-slate-700 mr-4">${agentName}</p>
                                    <a href="tel:${agentPhone}" class="text-indigo-600 hover:underline">${agentPhone}</a>
                                </div>
                            </div>
                        `;
                        elements.roomListEl.appendChild(roomDiv);
                    });
                    attachBookButtonListeners();
                } else {
                    elements.roomListEl.innerHTML = '<p class="text-slate-500 font-semibold">No available rooms found for this property.</p>';
                }
            } catch (error) {
                elements.propertyNameEl.textContent = 'Error';
                elements.roomListEl.innerHTML = '<p class="text-red-500">Could not load room details. Please try again.</p>';
                console.error('Fetch error:', error);
            }
        }
        document.addEventListener('click', function(event) {
            const target = event.target.closest('.gallery-arrow');

            if (!target) {
                return; // Exit if the click was not on an arrow
            }

            const galleryContainer = target.closest('.room-gallery-container');
            const imageElement = galleryContainer.querySelector('.room-image');
            const dataElement = galleryContainer.querySelector('.image-data');
            
            const images = JSON.parse(dataElement.dataset.images);
            let currentIndex = parseInt(dataElement.dataset.currentIndex, 10);
            const totalImages = images.length;

            if (totalImages <= 1) {
                return; // No need to cycle if there's only one image
            }

            // Determine if the "next" or "previous" button was clicked
            if (target.classList.contains('next-btn')) {
                currentIndex = (currentIndex + 1) % totalImages;
            } else if (target.classList.contains('prev-btn')) {
                currentIndex = (currentIndex - 1 + totalImages) % totalImages;
            }

            // Update the image source and the current index
            imageElement.src = images[currentIndex];
            dataElement.dataset.currentIndex = currentIndex;
        });
        
        function attachBookButtonListeners() { 
            document.querySelectorAll('.book-room-btn').forEach(button => {
            button.addEventListener('click', function() {
                const roomId = this.dataset.roomId;
                const roomNumber = this.dataset.roomNumber;
                
                elements.bookingRoomIdInput.value = roomId;
                elements.bookingSubmitBtn.disabled = false;
                elements.bookingSubmitBtn.textContent = `Request to Book Room #${roomNumber}`;
                elements.bookingSubmitBtn.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
                elements.bookingSubmitBtn.classList.remove('bg-indigo-400', 'cursor-not-allowed');
                elements.bookingInstructions.textContent = `You have selected Room #${roomNumber}. Please choose your dates.`;
                
                document.querySelectorAll('#modalRoomList .p-4.border').forEach(div => div.classList.remove('ring-2', 'ring-indigo-500'));
                this.closest('.p-4.border').classList.add('ring-2', 'ring-indigo-500');
            });
        });

         }
        function resetBookingForm() {
            if (elements.bookingForm) elements.bookingForm.reset();
            if (elements.bookingRoomIdInput) elements.bookingRoomIdInput.value = '';
            if (elements.bookingSubmitBtn) {
                elements.bookingSubmitBtn.disabled = true;
                elements.bookingSubmitBtn.textContent = 'Select a Room First';
                elements.bookingSubmitBtn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
                elements.bookingSubmitBtn.classList.add('bg-indigo-400', 'cursor-not-allowed');
            }
            if (elements.bookingInstructions) elements.bookingInstructions.textContent = 'Please select a room from the list to make a booking request.';
            document.querySelectorAll('#modalRoomList .p-4.border').forEach(div => div.classList.remove('ring-2', 'ring-indigo-500'));
        }

        // ===================================================================
        // 4. INITIAL PAGE LOAD LOGIC
        // ===================================================================
        const activeSectionFromSession = @json(session('active_section'));
        if (activeSectionFromSession) {
            setActiveLink(activeSectionFromSession);
            showSection(activeSectionFromSession);
        } else {
            const defaultActiveLink = document.querySelector('.sidebar-link.active');
            if (defaultActiveLink) {
                showSection(defaultActiveLink.getAttribute('data-target'));
            }
        }

            
});

</script>
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChY6UgjP5yMfhA4te6N2N_OWsY4yssR-Q&libraries=maps,marker&v=beta"></script>
</body>
</html>