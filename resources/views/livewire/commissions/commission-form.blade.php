<div class="p-2">
    <form wire:submit.prevent="submit">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if (isset($id))
                {{ __('commissions.labels.edit_form_title') }}
            @else
                {{ __('commissions.labels.create_form_title') }}
            @endif
        </h3>

       
       
        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="client_id">{{ __('commissions.attributes.client_name') }}</label>
            </div>
            <select wire:model="client_id" id="client_id">
                <option value="" disabled selected>{{ __('commissions.actions.choose_client') }}</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>





        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="worker_name">{{ __('commissions.attributes.worker_name') }}</label>
            </div>
            <select wire:model="worker_id" id="worker_id">
                <option value="" disabled selected>{{ __('commissions.actions.choose_worker') }}</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

        </div>


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="service_name">{{ __('commissions.attributes.service_name') }}</label>
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
                <label for="device_imei">{{ __('commissions.attributes.device_imei') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="device_imei" />
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="device_sn">{{ __('commissions.attributes.device_sn') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="device_sn" />
            </div>
        </div>




        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="description">{{ __('commissions.attributes.description') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="description" />
            </div>
        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('commissions.index') }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.cancel') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.placeholder.save') }}" spinner />
        </div>
    </form>
</div>
