<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                <div class="p-6 text-gray-900 flex items-center gap-5" x-data="{ count: 0 }">
                    <!-- Render the current "count" value inside an element... -->


                    <!-- Increment the "count" value by "1" when a click event is dispatched... -->
                    <button x-on:click="count--" class="px-3 py-1 border">-</button>
                    <h2 x-text="count"></h2>
                    <button x-on:click="count++" class="px-3 py-1 border">+</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
