<x-guest-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl font-bold">Socialite Provider Error</h2>
                    <p class="mt-4">An error occurred with the social login provider.</p>
                    <p class="my-2"><strong>Error Message:</strong> {{ $exception->getMessage() }}</p>
                    <hr>
                    @if (app()->environment('local'))
                        <pre class="w-full overflow-hidden h-96 overflow-x-scroll overflow-y-scroll mt-4 p-4 bg-gray-200 rounded">{{ $exception }}</pre>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
