<div class="p-2">
    <form wire:submit.prevent="submit">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if (isset($id))
                {{ __('users.labels.edit_form_title') }}
            @else
                {{ __('users.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">



            <div class="">
                <label for="name">{{ __('users.attributes.name') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="" wire:model="name" />
            </div>

            <div class="">
                <label for="last_name">{{ __('users.attributes.last_name') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="" wire:model="last_name" />
            </div>

            <div class="">
                <label for="phone_number">{{ __('users.attributes.phone_number') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="" wire:model="phone_number" />
            </div>


            <div class="">
                <label for="email">{{ __('users.attributes.email') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="" wire:model="email" />
            </div>


            <div class="">
                <label for="nip">{{ __('users.attributes.nip') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="" wire:model="nip" />
            </div>

            <div class="">
                <label for="city">{{ __('users.attributes.city') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="" wire:model="city" />
            </div>


            <div class="">
                <label for="street">{{ __('users.attributes.street') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="" wire:model="street" />
            </div>

            <div class="">
                <label for="street_number">{{ __('users.attributes.street_number') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="" wire:model="street_number" />
            </div>

            <div class="">
                <label for="post_code">{{ __('users.attributes.post_code') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="" wire:model="post_code" />
            </div>


            <div class="">
                <label for="description">{{ __('users.attributes.description') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="" wire:model="description" />
            </div>

        </div>

        

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('users.index') }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.cancel') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.placeholder.save') }}" spinner />
        </div>
    </form>
</div>
