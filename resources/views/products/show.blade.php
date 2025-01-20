<x-app-layout>
<body>
<div class="content">   
    <div class="table_div">
        <table>
            <tr>
             <br>
                <th class="left_table">{{ __('products.attributes.product_name')}}:</th>
                <th class="right_table">{{$product->product_name }}</th>
            </tr>
            <tr>
                <th class="left_table">  {{ __('products.attributes.unit') }}:</th>
                <th class="right_table">{{ $product->unit }}</th>
            </tr>
            <tr>
                <th class="left_table">    {{ __('products.attributes.amount') }}:</th>
                <th class="right_table"> {{ $product->amount }}</th>
            </tr>
            <tr>
                <th class="left_table"> {{ __('products.attributes.price') }}:</th>
                <th class="right_table"> {{ $product->price }}</th>
            </tr>
            <tr>
                <th class="left_table"> {{ __('products.attributes.description') }}:</th>
                <th class="right_table"> {{ $product->description }}</th>
            </tr>
        </table>
    </div>
    <div class="button_divbox">
    <x-wireui-button href="{{ route('users.index') }}" secondary class="mr-2"
    label="{{ __('translation.placeholder.edit') }}" />

    <x-wireui-button href="{{ route('users.index') }}" secondary class="mr-2"
    label="{{ __('translation.placeholder.remove') }}" />

    <x-wireui-button href="{{ route('products.index') }}" secondary class="mr-2"
    label="{{ __('translation.placeholder.cancel') }}" />
    
    <!-- <button href="{{ route('products.index') }}" class="options_e">
    {{ __('translation.placeholder.edit') }}
        </button>

    <button href="{{ route('products.index') }}" class="options_r" >
    {{ __('translation.placeholder.remove') }}
    </button>

    <button href="{{ route('products.index') }}" class="options_a">
        {{ __('translation.placeholder.cancel') }}
    </button> -->

    </div>
</div>
</body>
</x-app-layout>
