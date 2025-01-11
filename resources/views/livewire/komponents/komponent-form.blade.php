<div class="p-2">
    <form wire:submit.prevent="submit">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if (isset($id))
                {{ __('komponents.labels.edit_form_title') }}
            @else
                {{ __('komponents.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="komponent_name">{{ __('komponents.attributes.komponent_name') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="komponent_name" />
            </div>

            <div class="">
                <label for="price">{{ __('komponents.attributes.price') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Cena') }}" wire:model="price" />
            </div>

            <div class="">
                <label for="description">{{ __('komponents.attributes.description') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="description" />
            </div>
        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('komponents.index') }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.cancel') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.placeholder.save') }}" spinner />
        </div>
    </form>
</div>
