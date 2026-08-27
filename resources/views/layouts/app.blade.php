<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Registration System')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

    {{-- Navigation Bar --}}
    <nav class="bg-white shadow-md">
        <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('students.create') }}" class="text-xl font-bold text-blue-600">
                Student Registration
            </a>
            <div class="text-sm text-gray-500">
                ITST 302 — Week 4
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    <div class="max-w-5xl mx-auto px-4 mt-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg flex items-center gap-2">
                <span class="text-xl">✅</span>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg flex items-center gap-2">
                <span class="text-xl">❌</span>
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg">
                <strong>⚠️ Please fix the following errors:</strong>
                <ul class="list-disc list-inside mt-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    {{-- Main Content --}}
    <main class="max-w-5xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="text-center text-gray-400 text-sm py-6 border-t mt-8">
        ITST 302 – Client-Server Technologies &bull; Week 4 Laboratory Activity
    </footer>

</body>
</html>