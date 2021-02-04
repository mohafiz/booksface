<x-app-layout>
	<x-slot name="title">
		Add Books
	</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Books') }}
        </h2>
    </x-slot>

    <!-- Begin Add -->

    <livewire:addbooks />

    <!-- End Add -->

</x-app-layout>