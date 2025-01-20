
<form wire:submit.prevent="submit">
    <div class="content">   
        <div class="table_div">
            <h3 class="imie">

                @if (isset($id))
                {{ __('orderproducts.labels.edit_form_title') }}
                @else
                    {{ __('orderproducts.labels.create_form_title') }}
                @endif
            </h3>
            
                <table>
                    
                    <tr>
                        <th class="left_table"> 
                        <label for="order_id">{{ __('orderproducts.attributes.order_id') }}</label>
                        </th>
                        <th class="right_table">
                        @if($order_created)
                            <select wire:model="order_id" id="order_id" disabled="true">
                        @else
                            <select wire:model="order_id" id="order_id">
                        @endif
                            <option value="" disabled selected>{{ __('orders.actions.choose_order') }}</option>
                            @foreach ($orders as $order)
                                <option value="{{ $order->id }}">{{ $order->id }}: {{ $order->client_name }} {{ $order->client_last_name }}</option>
                            @endforeach
                        </select>
                        </th>
                    </tr>

                    <tr>
                        <th class="left_table"> 
                        <label for="product_id">{{ __('orderproducts.attributes.product_name') }}</label>
                        </th>
                        <th class="right_table">
                        <select wire:model="product_id" id="product_id">
            <option value="" disabled selected>{{ __('orderproducts.actions.choose_product') }}
            </option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->product_name }}: {{ $product->price }} zł</option>
            @endforeach
        </select>
                        </th>
                    </tr>
                
                    <tr>
                        <th class="left_table"> 
                        <label for="amount">{{ __('orderproducts.attributes.amount') }}</label>
                        </th>
                        <th class="right_table">
                        <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="amount" />
                        </th>
                    </tr>

                    

                </table>
            </div>
            <div class="button_divbox">
            @if($order_created)
                <x-wireui-button href="{{ route('orders.index') }}" secondary class="mr-2" label="{{ __('translation.placeholder.cancel') }}" />
            @else
                <x-wireui-button href="{{ route('orderproducts.index') }}" secondary class="mr-2" label="{{ __('translation.placeholder.cancel') }}" />
            @endif
            
            <x-wireui-button type="submit" primary label="{{ __('translation.placeholder.save') }}" spinner />
            </div>
        </div>
    </div>

</form>


