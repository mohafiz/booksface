<x-app-layout>
    <x-slot name="title">
        My Cart
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Cart
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                <!-- Begin List -->
                <livewire:mycart :userbooks="$userbooks"/>

                <!-- End List -->

            </div>
        </div>
    </div>
</x-app-layout>