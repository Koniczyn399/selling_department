<div class="p-2">
    <form wire:submit.prevent="submit">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if (isset($id))
                {{ __('employees.labels.edit_form_title') }}
            @else
                {{ __('employees.labels.create_form_title') }}
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
                <label for="nip">{{ __('users.attributes.nip') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="" wire:model="nip" />
            </div>


            <div class="">
                <label for="position">{{ __('employees.attributes.position') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="" wire:model="position" />
            </div>

        </div>

        

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('employees.index') }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.cancel') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.placeholder.save') }}" spinner />
        </div>
    </form>
</div>
