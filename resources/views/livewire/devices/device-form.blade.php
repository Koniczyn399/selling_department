<div class="p-2">
    <form wire:submit.prevent="submit">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if (isset($id))
                {{ __('devices.labels.edit_form_title') }}
            @else
                {{ __('devices.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="brand">{{ __('devices.attributes.brand') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="brand" />
            </div>

            <div class="">
                <label for="model">{{ __('devices.attributes.model') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="model" />
            </div>

            <div class="">
                <label for="description">{{ __('devices.attributes.description') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="description" />
            </div>








        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('devices.index') }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.cancel') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.placeholder.save') }}" spinner />
        </div>
    </form>
</div>
