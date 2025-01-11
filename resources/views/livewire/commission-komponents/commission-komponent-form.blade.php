<div class="p-2">
    <form wire:submit.prevent="submit">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if (isset($id))
                {{ __('commissionkomponents.labels.edit_form_title') }}
            @else
                {{ __('commissionkomponents.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">


            <div class="">
                <label for="commission_id">{{ __('commissionkomponents.attributes.commission') }}</label>
            </div>
            <div class="">
            <select wire:model="commission_id" id="commission_id">
                    <option value="" disabled selected>{{ __('services.actions.choose_commission') }}</option>
                    @foreach($commissions as $commission)
                        <option value="{{ $commission->id }}">{{$commission->id}}:  {{$commission->client_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="">
                <label for="product_id">{{ __('commissionkomponents.attributes.product_name') }}</label>
            </div>
            <div class="">
            <select wire:model="product_id" id="product_id">
                    <option value="" disabled selected>{{ __('commissionkomponents.actions.choose_product') }}</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{$product->product_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="">
                <label for="amount">{{ __('commissionkomponents.attributes.amount') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="amount" />
            </div>

            <div class="">
                <label for="price">{{ __('commissionkomponents.attributes.price') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="price" />
            </div>

            <div class="">
                <label for="description">{{ __('commissionkomponents.attributes.description') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="description" />
            </div>
        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('commissionkomponents.index') }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.cancel') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.placeholder.save') }}" spinner />
        </div>
    </form>
</div>
