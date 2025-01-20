<body>
    <form wire:submit.prevent="submit">
        <div class="content">   
            <div class="table_div">
                <h3 class="imie">
                    @if (isset($id))
                        {{ __('orders.labels.edit_form_title') }} 
                    @else
                        {{ __('orders.labels.create_form_title') }}  
                    @endif
                </h3>
             
                    <table>
                       
                        <tr>
                            <th class="left_table"> <label for="id">{{ __('orders.attributes.order_id') }}:</label></th>
                            <th class="right_table">                <x-wireui-input disabled placeholder="{{ $id}}" /></th>
                        </tr>
                    
                        <tr>
                            <th class="left_table">   <label for="date_of_order">{{ __('orders.attributes.date_of_order') }}:</label></th>
                            <th class="right_table">


                            <x-wireui-datetime-picker
                                wire:model="date_of_order"
                                label="{{ __('orders.attributes.date_of_order') }}"
                                placeholder="{{ __('orders.attributes.date_of_order') }}"
                                parse-format="YYYY-MM-DD"
                            />


                            
                            </th>
                        </tr>
                        <tr>
                            <th class="left_table"> <label for="client_name">{{ __('orders.attributes.client_name') }}:</label></th>
                            <th class="right_table"> 
                            
                            <select wire:model="client_id" id="client_id">
                                <option value="" disabled selected>{{ __('orders.actions.choose_client') }}</option>
                                @foreach ($users as $user)
                                    @if($user->position == "")
                                            <option value="{{ $user->id }}">{{ $user->name }} {{$user->last_name}} </option>
                                    @endif
                                @endforeach
                            </select>

                            </th>
                        </tr>
                        <tr>
                            <th class="left_table"> <label for="seller_name">{{ __('orders.attributes.seller_name') }}:</label>
                            </th>
                            <th class="right_table">  

                                <select wire:model="seller_id" id="seller_id">
                                    <option value="" disabled selected>{{ __('orders.actions.choose_seller') }}</option>
                                
                                    @foreach ($sellers as $seller)
                                        <option value="{{ $seller->id }}">{{ $seller->name}} {{$seller->last_name }} </option>
                                    @endforeach
                                </select>

                            </th>
                        </tr>
                       
                    </table>
                </div>
                <div class="button_divbox">
                    <x-wireui-button href="{{ route('orders.index') }}" secondary class="mr-2"
                        label="{{ __('translation.placeholder.cancel') }}" />
                    <x-wireui-button type="submit" primary label="{{ __('translation.placeholder.save') }}" spinner />
                </div>
            </div>
        </div>

    </form>
</body>

