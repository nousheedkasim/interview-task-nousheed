<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body class="flex items-center justify-center h-screen">


    <div class="max-w-md mx-auto mt-20 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-700">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" required autofocus
                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" required
                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            </div>
            
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">
                Login
            </button>
        </form>
    </div>
</body>
</html>
