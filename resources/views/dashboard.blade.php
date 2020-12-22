<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ 'Welcome '.auth()->user()->name.', You are logged in' }}

                    <x-button class="ml-4">
                        <a class="underline text-sm text-white-600 hover:text-white-900" href="{{ route('license') }}">
                            {{ __('Generate License?') }}
                        </a>
                    </x-button>
                    <x-button class="ml-4">
                        <a class="underline text-sm text-white-600 hover:text-white-900" href="{{ route('license-form') }}">
                            {{ __('Activate License?') }}
                        </a>
                    </x-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
