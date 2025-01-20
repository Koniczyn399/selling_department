<x-app-layout>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
        
        <div class="content">
            <div class="imie">
                <p> {{$user->name }} {{$user->last_name }}</p>
            </div>
            <div class="table_div">
                <table>
                    <tr>
                        <th class="left_table">{{ __('users.attributes.phone_number') }}: </th>
                        <th class="right_table">{{ $user->phone_number }}</th>
                    </tr>
                    <tr>
                        <th class="left_table"> {{ __('users.attributes.email') }}:</th>
                        <th class="right_table"> {{ $user->email }}</th>
                    </tr>
                    <tr>
                        <th class="left_table"> {{ __('users.attributes.nip') }}:</th>
                        <th class="right_table"> {{ $user->nip }}</th>
                    </tr>
                    <tr>
                        <th class="left_table"> {{ __('users.attributes.city') }}:</th>
                        <th class="right_table"> {{ $user->city }}</th>
                    </tr>
                    <tr>
                        <th class="left_table">{{ __('users.attributes.street') }}:</th>
                        <th class="right_table">{{ $user->street }}</th>
                    </tr>
                    <tr>
                        <th class="left_table">{{ __('users.attributes.post_code') }}:</th>
                        <th class="right_table">{{ $user->post_code }}</th>
                    </tr>
                    <tr>
                        <th class="left_table">{{ __('users.attributes.street_number') }}:</th>
                        <th class="right_table">{{ $user->street_number }}</th>
                    </tr>
                    <tr>
                        <th class="left_table">{{ __('users.attributes.unit_nr') }}:</th>
                        <th class="right_table">{{ $user->unit_nr }}</th>
                    </tr>
                    <tr>
                        <th class="left_table">{{ __('users.attributes.description') }}:</th>
                        <th class="right_table">{{ $user->description }}</th>
                    </tr>
                </table>
            
            </div>
            <div class="button_divbox">
                <x-wireui-button href="{{ route('employees.index') }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.cancel') }}" />
          
        </div>
    </body>
</html>


</x-app-layout>


        
                        


