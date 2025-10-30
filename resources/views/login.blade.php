<x-guest-layout>
    <div class="max-w-md mx-auto mt-20 bg-white p-8 rounded-lg shadow-md">

    @if ($errors->any())
            <div class="alert">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul style="margin-top: 0.5rem; padding-left: 1.2rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
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
</x-guest-layout>
