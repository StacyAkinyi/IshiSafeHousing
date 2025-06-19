@extends('layouts.app') {{-- Assuming you have a layout file --}}

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-slate-800">My Account</h1>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Personal Details Form --}}
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold mb-4 text-slate-700">Personal Details</h2>
            <form action="{{ route('student.account.updateDetails') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-600">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-600">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Phone Number --}}
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-slate-600">Phone Number</label>
                        <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('phone_number') border-red-500 @enderror">
                         @error('phone_number')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        {{-- Next of Kin Details Form --}}
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold mb-4 text-slate-700">Next of Kin Details</h2>
            <form action="{{ route('student.account.updateNextOfKin') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    {{-- Kin Name --}}
                    <div>
                        <label for="kin_name" class="block text-sm font-medium text-slate-600">Full Name</label>
                        <input type="text" name="kin_name" id="kin_name" value="{{ old('kin_name', $user->nextOfKin->name ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('kin_name') border-red-500 @enderror">
                        @error('kin_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kin Relationship --}}
                    <div>
                        <label for="kin_relationship" class="block text-sm font-medium text-slate-600">Relationship</label>
                        <input type="text" name="kin_relationship" id="kin_relationship" value="{{ old('kin_relationship', $user->nextOfKin->relationship ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('kin_relationship') border-red-500 @enderror">
                        @error('kin_relationship')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kin Phone Number --}}
                    <div>
                        <label for="kin_phone_number" class="block text-sm font-medium text-slate-600">Phone Number</label>
                        <input type="tel" name="kin_phone_number" id="kin_phone_number" value="{{ old('kin_phone_number', $user->nextOfKin->phone_number ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('kin_phone_number') border-red-500 @enderror">
                        @error('kin_phone_number')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kin Email --}}
                    <div>
                        <label for="kin_email" class="block text-sm font-medium text-slate-600">Email Address (Optional)</label>
                        <input type="email" name="kin_email" id="kin_email" value="{{ old('kin_email', $user->nextOfKin->email ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('kin_email') border-red-500 @enderror">
                        @error('kin_email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save Next of Kin
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection