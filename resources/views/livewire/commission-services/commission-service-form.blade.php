<div class="p-2">
    <form wire:submit.prevent="submit">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if (isset($id))
                {{ __('commissionservices.labels.edit_form_title') }}
            @else
                {{ __('commissionservices.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="commission_id">{{ __('commissionservices.attributes.commission') }}</label>
            </div>
            <select wire:model="commission_id" id="commission_id">
                    <option value="" disabled selected>{{ __('services.actions.choose_commission') }}</option>
                    @foreach($commissions as $commission)
                        <option value="{{ $commission->id }}">{{$commission->id}}:  {{$commission->client_name }}</option>
                    @endforeach
                </select>
        </div>


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="service_id">{{ __('commissionservices.attributes.service_id') }}</label>
            </div>
            <select wire:model="service_id" id="service_id">
                <option value="" disabled selected>{{ __('commissions.actions.choose_service') }}</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                @endforeach
            </select>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="amount">{{ __('commissionservices.attributes.amount') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="amount" />
            </div>
        </div>


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="price">{{ __('commissionservices.attributes.price') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="price" />
            </div>
        </div>


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="description">{{ __('commissionservices.attributes.description') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="description" />
            </div>
        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('commissionservices.index') }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.cancel') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.placeholder.save') }}" spinner />
        </div>
    </form>
</div>
