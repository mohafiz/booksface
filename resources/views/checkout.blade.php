<x-app-layout>
	<x-slot name="title">
		Checkout
	</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <!-- Begin Add -->

    <livewire:checkout />

    <!-- End Add -->

</x-app-layout>