<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex bg-gray-100 min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col fixed h-full">
        <div class="p-4 text-2xl font-semibold border-b border-gray-700">
            My Dashboard
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">Dashboard</a>
            <a href="{{ route('events.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Events</a>
            <a href="{{ route('sessions.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Sessions</a>
            <a href="{{ route('speakers.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Speakers</a>
            <a href="{{ route('event_session_speaker.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Session Roster</a>
        </nav>

        <div class="p-4 border-t border-gray-700">
        <a href="{{ route('logout') }}" 
   class="block w-full text-center py-2 bg-red-600 hover:bg-red-700 text-white rounded">
    Logout
</a>
            
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-6 pb-20 bg-white"> {{-- Added pb-20 for footer spacing --}}
        <h1 class="text-3xl font-bold mb-6">{{ $title ?? config('app.name', 'Laravel App') }}</h1>
        

        {{ $slot }}
    </main>

    <!-- Fixed Footer Bar -->
    <footer class="fixed bottom-0 left-64 right-0 bg-white border-t border-gray-200 shadow-md">
        <div class="flex justify-end items-center px-6 py-3 text-sm text-gray-600">
           
            
            {{ $footer ?? '' }}
            
        </div>
    </footer>

    

</body>
</html>
