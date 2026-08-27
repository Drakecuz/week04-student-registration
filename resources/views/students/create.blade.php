@extends('layouts.app')

@section('title', 'Register Student')

@section('content')

<div class="bg-white rounded-xl shadow-lg p-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-2">Student Registration Form</h1>
    <p class="text-gray-500 mb-6">Fill in all required fields (<span class="text-red-500">*</span>) to register a new student.</p>

    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Row: Student ID --}}
        <div>
            <label for="student_id" class="block text-sm font-medium text-gray-700 mb-1">
                Student ID <span class="text-red-500">*</span>
            </label>
            <input type="text" name="student_id" id="student_id" value="{{ old('student_id') }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('student_id') border-red-500 @enderror"
                   placeholder="e.g. 2024-0001">
            @error('student_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Row: Full Name --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('first_name') border-red-500 @enderror"
                           placeholder="First Name">
                    @error('first_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Middle Name (optional)">
                </div>
                <div>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('last_name') border-red-500 @enderror"
                           placeholder="Last Name">
                    @error('last_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Row: Email & Mobile --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    Email Address <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                       placeholder="student@example.com">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="mobile_number" class="block text-sm font-medium text-gray-700 mb-1">
                    Mobile Number <span class="text-red-500">*</span>
                </label>
                <input type="text" name="mobile_number" id="mobile_number" value="{{ old('mobile_number') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('mobile_number') border-red-500 @enderror"
                       placeholder="09171234567">
                @error('mobile_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Row: Date of Birth & Gender --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">
                    Date of Birth <span class="text-red-500">*</span>
                </label>
                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('date_of_birth') border-red-500 @enderror">
                @error('date_of_birth')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">
                    Gender <span class="text-red-500">*</span>
                </label>
                <select name="gender" id="gender"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('gender') border-red-500 @enderror">
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Row: Program & Year Level --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="program" class="block text-sm font-medium text-gray-700 mb-1">
                    Program <span class="text-red-500">*</span>
                </label>
                <select name="program" id="program"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('program') border-red-500 @enderror">
                    <option value="">Select Program</option>
                    <option value="BSIT" {{ old('program') == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                    <option value="BSCS" {{ old('program') == 'BSCS' ? 'selected' : '' }}>BSCS</option>
                    <option value="BSIS" {{ old('program') == 'BSIS' ? 'selected' : '' }}>BSIS</option>
                    <option value="BSEMC" {{ old('program') == 'BSEMC' ? 'selected' : '' }}>BSEMC</option>
                    <option value="BSDA" {{ old('program') == 'BSDA' ? 'selected' : '' }}>BSDA</option>
                </select>
                @error('program')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="year_level" class="block text-sm font-medium text-gray-700 mb-1">
                    Year Level <span class="text-red-500">*</span>
                </label>
                <select name="year_level" id="year_level"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('year_level') border-red-500 @enderror">
                    <option value="">Select Year Level</option>
                    <option value="1st Year" {{ old('year_level') == '1st Year' ? 'selected' : '' }}>1st Year</option>
                    <option value="2nd Year" {{ old('year_level') == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                    <option value="3rd Year" {{ old('year_level') == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                    <option value="4th Year" {{ old('year_level') == '4th Year' ? 'selected' : '' }}>4th Year</option>
                </select>
                @error('year_level')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Row: Address --}}
        <div>
            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                Address <span class="text-red-500">*</span>
            </label>
            <textarea name="address" id="address" rows="3"
                      class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('address') border-red-500 @enderror"
                      placeholder="Complete address">{{ old('address') }}</textarea>
            @error('address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Row: Profile Picture --}}
        <div>
            <label for="profile_picture" class="block text-sm font-medium text-gray-700 mb-1">
                Profile Picture <span class="text-red-500">*</span>
            </label>
            <input type="file" name="profile_picture" id="profile_picture" accept="image/jpeg,image/png,image/jpg"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('profile_picture') border-red-500 @enderror">
            <p class="text-gray-400 text-xs mt-1">Accepted: JPG, JPEG, PNG only. Max 2MB.</p>
            @error('profile_picture')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="flex items-center gap-4 pt-4 border-t">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-200">
                 Register Student
            </button>
            <button type="reset"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium px-6 py-3 rounded-lg transition duration-200">
                Clear Form
            </button>
        </div>
    </form>
</div>

@endsection