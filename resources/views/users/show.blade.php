<x-app-layout>
@if($order_products ==null)
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
                <x-wireui-button href="{{ route('users.edit',[$user]) }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.edit') }}" />

                <x-wireui-button href="{{ route('users.index') }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.remove') }}" />

                <x-wireui-button href="{{ route('users.index') }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.cancel') }}" />
            </div>
        </div>
    </body>
</html>

@else
<html>
    <head>
        <style>
              
                .aside {
                    display: flex;
                    font-family: Arial, Helvetica, sans-serif;
                    padding-left: 15px;
                    padding-right: 15px;

                    margin-top: 5px;
                    margin-bottom: 8px;
                   
                    margin-left: 15px;
                    margin-right: 15px;

                    border-radius: 18px;
                    background-color: white;
                    font-size: 22px;
                }
                
                th{
                    border: 0;
                    text-align: left;
                    background-color: #f1f1f1;
                    font-size: 22px;
                }
                tr{
                    border: 0;
                }
                table{
                    border: 0; 
                }

                .flex-container {
                   display: flex;
                   background-color: rgba(226, 223, 223, 0.82);
                   border-radius: 25px;
                   border: 2px outset rgba(41, 41, 41, 0.49);
                   margin-left: 80px;
                   margin-right: 80px;  
                   flex-wrap: wrap;
               }

               .flex-container > div {
                   background-color: #f1f1f1;
                   margin: 10px;
                   padding: 20px;
                   font-size: 15px;
               }

                .table_div{
                    flex: 1;
                    height: 300px;                  
                }
                .orders_div{
                    flex: 4;
                }
                .th_white > th {
                    background-color:rgb(255, 255, 255);
                    padding-left: 15px;
                    padding-right: 15px;
                }
                .blank > th{
                    display:none
                }

        </style>
    </head>
    <body>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.orders_history') }}
        </h2>
    </x-slot>


    <div class="flex-container">
        <div class="table_div">
        
            <table >
                    <tr>
                        <th>{{__("users.attributes.clients")}}</th><th></th>
                    </tr>
                    <tr>
                        <th>{{__("users.attributes.id")}}</th><th> {{$user->id}}</th>
                    </tr>
                    <tr>
                        <th>{{__("users.attributes.name")}}</th><th> {{$user->name}}</th>
                    </tr>
                    <tr>
                        <th>{{__("users.attributes.last_name")}}</th><th> {{$user->last_name}}</th>
                    </tr>
                    <tr>
                        <th>{{__("users.attributes.nip")}}</th><th> {{$user->nip}}</th>
                    </tr>
                    <tr>
                        <th>{{__("users.attributes.post_code")}}</th><th>{{$user->post_code}}</th>
                    </tr>
                    <tr>
                        <th>{{__("users.attributes.city")}}</th><th>{{$user->city}}</th>
                    </tr>
                </table>
               
        </div>
        
        <div class="orders_div">
            @foreach ($orders as $order)
                <div class="aside">
                    <div>
                        <table>
                            <tr class="th_white">
                                <th >Nr Zamówienia</th> 
                            </tr>
                            <tr class="th_white">
                                <th>{{$order->id }}</th> 
                            </tr>
                            <tr class="th_white">
                                <th>Data złożenia
                                </th>
                            </tr>
                            <tr class="th_white">
                                <th>
                                    {{$order->created_at}}
                                </th>
                            </tr>
                        </table>
                    </div> 
                    <div >
                        <table >
                            <tr class="th_white">
                            <th>Towary</th> <th> Ilość</th> <th>Cena[PLN]</th>
                            </tr>

                            
                            @foreach ($order_products as $order_product)
                                @if( $order->id  == $order_product->order_id)
                                    <tr class="th_white">
                                        <th> {{$order_product->product_name}}</th> <th> {{$order_product->amount}}</th> <th> {{$order_product->price}}</th>
                                    </tr>
                                    <tr class="blank">
                                        <th> 
                                            {{$var = $var + $order_product->amount * $order_product->price}}
                                        </th> 
                                    </tr>
 
                                @endif
                            @endforeach

                            
                        </table>
                    </div>
                    <div style="font-size: 30px;  text-align: center;">
                        Kwota łączna: {{$var}}
                    </div>
                </div>
            @endforeach
        </div>

       
    </div>



    <div class="button_divbox">
                <x-wireui-button href="{{ route('users.index') }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.edit') }}" />

                <x-wireui-button href="{{ route('users.index') }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.remove') }}" />

                <x-wireui-button href="{{ route('users.index') }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.cancel') }}" />
            </div>


</body>
</html>
@endif

</x-app-layout>


        
                        


