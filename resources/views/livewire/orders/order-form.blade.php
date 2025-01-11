<div class="p-2">
    <form wire:submit.prevent="submit">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if (isset($id))
                {{ __('orders.labels.edit_form_title') }}
            @else
                {{ __('orders.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="client_name">{{ __('orders.attributes.client_name') }}</label>
            </div>
            <select wire:model="client_id" id="client_id">
                <option value="" disabled selected>{{ __('orders.actions.choose_client') }}</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="worker_name">{{ __('orders.attributes.worker_name') }}</label>
            </div>
            <select wire:model="worker_id" id="worker_id">
                <option value="" disabled selected>{{ __('orders.actions.choose_worker') }}</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="order_state_name">{{ __('orders.attributes.order_state_name') }}</label>
            </div>
            <select wire:model="order_state_id" id="order_state_id">
                <option value="" disabled selected>{{ __('orders.actions.choose_order_state') }}</option>
                @foreach ($orderstates as $orderstate)
                    <option value="{{ $orderstate->id }}">{{ $orderstate->order_state_name }}</option>
                @endforeach
            </select>
        </div>


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="deadline_of_completion">{{ __('orders.attributes.deadline_of_completion') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="deadline_of_completion" />
            </div>
        </div>


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="date_of_completion">{{ __('orders.attributes.date_of_completion') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="date_of_completion" />
            </div>
        </div>



        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="price">{{ __('orders.attributes.price') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="price" />
            </div>
        </div>


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="v">{{ __('orders.attributes.description') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('Wpisz') }}" wire:model="description" />
            </div>
        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('orders.index') }}" secondary class="mr-2"
                label="{{ __('translation.placeholder.cancel') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.placeholder.save') }}" spinner />
        </div>
    </form>
</div>
