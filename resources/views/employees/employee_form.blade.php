<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.employees') }}
        </h2>
    </x-slot>

    @if (isset($employee->id)) 
    
        <livewire:employees.employee-form :employee="$employee" />
    @else
        <livewire:employees.employee-form/>
    @endif

</x-app-layout>
