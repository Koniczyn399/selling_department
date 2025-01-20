<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.users') }}
        </h2>
    </x-slot>              
    @if (isset($user->id)) 
    
        <livewire:users.user-form :user="$user" />
    @else
        <livewire:users.user-form />
    @endif

</x-app-layout>
