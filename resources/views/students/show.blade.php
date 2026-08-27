@extends('layouts.app')

@section('title', 'Student Profile')

@section('content')

<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-8 py-6 text-white">
        <h1 class="text-2xl font-bold">Student Profile</h1>
        <p class="text-blue-100 mt-1">Registration successful! Here are the student's details.</p>
    </div>

    <div class="p-8">
        {{-- Profile Picture --}}
        <div class="flex flex-col items-center mb-8">
            <div class="w-36 h-36 rounded-full overflow-hidden border-4 border-blue-200 shadow-lg">
                @if($student->profile_picture)
                    <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="Profile Picture"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-5xl">
                        👤
                    </div>
                @endif
            </div>
            <h2 class="text-xl font-bold text-gray-800 mt-4">
                {{ $student->first_name }} {{ $student->middle_name ? $student->middle_name . ' ' : '' }}{{ $student->last_name }}
            </h2>
            <p class="text-gray-500">{{ $student->student_id }}</p>
        </div>

        {{-- Details Table --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Student ID</label>
                    <p class="text-gray-800 font-medium">{{ $student->student_id }}</p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Email Address</label>
                    <p class="text-gray-800 font-medium">{{ $student->email }}</p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Mobile Number</label>
                    <p class="text-gray-800 font-medium">{{ $student->mobile_number }}</p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Date of Birth</label>
                    <p class="text-gray-800 font-medium">{{ \Carbon\Carbon::parse($student->date_of_birth)->format('F d, Y') }}</p>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Gender</label>
                    <p class="text-gray-800 font-medium">{{ $student->gender }}</p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Program</label>
                    <p class="text-gray-800 font-medium">{{ $student->program }}</p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Year Level</label>
                    <p class="text-gray-800 font-medium">{{ $student->year_level }}</p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Address</label>
                    <p class="text-gray-800 font-medium">{{ $student->address }}</p>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="mt-8 pt-6 border-t flex flex-wrap gap-4">
            <a href="{{ route('students.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg transition duration-200">
                Register Another Student
            </a>
        </div>
    </div>
</div>

@endsection