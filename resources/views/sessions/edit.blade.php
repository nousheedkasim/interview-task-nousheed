




<x-layout title="Edit Session">
    <div class="flex justify-center mt-16">
        <div class="w-full max-w-lg p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-6 text-gray-800 text-center">Edit Session</h2>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            @include('sessions.form')
        </div>
    </div>
    <x-slot name="footer">
        <button
            type="submit"
            form="sessionForm"
            class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition duration-150"
        >
            {{ isset($session) ? 'Update session' : 'Create session' }}
        </button>
    </x-slot>
</x-layout>
