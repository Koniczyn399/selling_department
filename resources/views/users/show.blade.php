<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
              
                
                   
                     
                     
                        {{$user->name }}
                        {{$user->last_name  }} <br>
                        {{ __('users.attributes.phone_number') }}: {{ $user->phone_number }} <br>
                        {{ __('users.attributes.email') }}: {{ $user->email }}<br>
                        {{ __('users.attributes.nip') }}: {{ $user->nip }}<br>
                        {{ __('users.attributes.city') }}: {{ $user->city }}<br>
                        {{ __('users.attributes.street') }}: {{ $user->street }}<br>
                        {{ __('users.attributes.post_code') }}: {{ $user->post_code }}<br>
                        {{ __('users.attributes.street_number') }}: {{ $user->street_number }}<br>
                        {{ __('users.attributes.description') }}: {{ $user->description }}<br>
            </div>
        </div>
    </div>
</x-app-layout>
