<body>
    <form wire:submit.prevent="submit">
        <div class="content">   
            <div class="table_div">
                <h3 class="imie">
                    @if (isset($id))
                            {{ __('products.labels.edit_form_title') }}
                        @else
                            {{ __('products.labels.create_form_title') }}
                        @endif
                </h3>
                <div class="imie">
                        {{$product->product_name }}</p>
            </div>
                    <table>
                        @if (isset($id))
                            <tr>
                                <th class="left_table">{{ __('products.attributes.product_id')}}:</th>
                                <th class="right_table">{{$product->id }}</th>
                            </tr>
                        @endif
                        <tr>
                            <th class="left_table">  <label for="product_name">{{ __('products.attributes.product_name') }}</label>:</th>
                            <th class="right_table"><x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="product_name" /></th>
                        </tr>
                        <tr>
                            <th class="left_table"> <label for="unit">{{ __('products.attributes.unit') }}</label>:</th>
                            <th class="right_table"> <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="unit" /></th>
                        </tr>
                        <tr>
                            <th class="left_table"> <label for="price">{{ __('products.attributes.price') }}</label>:</th>
                            <th class="right_table">  <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="price" /></th>
                        </tr>
                        <tr>
                            <th class="left_table"> <label for="description">{{ __('products.attributes.description') }}</label>:</th>
                            <th class="right_table"> <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="description" /></th>
                        </tr>
                    </table>
                </div>
            <div class="button_divbox">
                <x-wireui-button href="{{ route('products.index') }}" secondary class="mr-2"
                    label="{{ __('translation.placeholder.cancel') }}" />
                <x-wireui-button type="submit" primary label="{{ __('translation.placeholder.save') }}" spinner />
            </div>
        </div>

    </form>
</body>

