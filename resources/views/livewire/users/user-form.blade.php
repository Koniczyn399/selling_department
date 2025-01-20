
<form wire:submit.prevent="submit">
    <div class="content">   
        <div class="table_div">
            <h3 class="imie">
                @if (isset($id))
                    {{ __('users.labels.edit_form_title') }}
                @else
                    {{ __('users.labels.create_form_title') }}
                @endif
            </h3>
            
                <table>
                    
                    <tr>
                        <th class="left_table"> 
                            <label for="name">{{ __('users.attributes.name') }}</label>
                        </th>
                        <th class="right_table">
                            <x-wireui-input placeholder="" wire:model="name" />
                        </th>
                    </tr>

                    <tr>
                        <th class="left_table"> 
                            <label for="last_name">{{ __('users.attributes.last_name') }}</label>
                        </th>
                        <th class="right_table">
                            <x-wireui-input placeholder="" wire:model="last_name" />
                        </th>
                    </tr>
                
                    <tr>
                        <th class="left_table"> 
                        <label for="phone_number">{{ __('users.attributes.phone_number') }}</label>
                        </th>
                        <th class="right_table">
                        <x-wireui-input placeholder="" wire:model="phone_number" />
                        </th>
                    </tr>

                    <tr>
                        <th class="left_table"> 
                        <label for="email">{{ __('users.attributes.email') }}</label>
                        </th>
                        <th class="right_table">
                        <x-wireui-input placeholder="" wire:model="email" />
                        </th>
                    </tr>

                    <tr>
                        <th class="left_table"> 
                        <label for="nip">{{ __('users.attributes.nip') }}</label>
                        </th>
                        <th class="right_table">
                        <x-wireui-input placeholder="" wire:model="nip" />
                        </th>
                    </tr>

                    <tr>
                        <th class="left_table"> 
                        <label for="city">{{ __('users.attributes.city') }}</label>
                        </th>
                        <th class="right_table">
                        <x-wireui-input placeholder="" wire:model="city" />
                        </th>
                    </tr>

                    <tr>
                        <th class="left_table"> 
                        <label for="street">{{ __('users.attributes.street') }}</label>
                        </th>
                        <th class="right_table">
                        <x-wireui-input placeholder="" wire:model="street" />
                        </th>
                    </tr>

                    <tr>
                        <th class="left_table"> 
                        <label for="street_number">{{ __('users.attributes.street_number') }}</label>
                        </th>
                        <th class="right_table">
                        <x-wireui-input placeholder="" wire:model="street_number" />
                        </th>
                    </tr>

                    <tr>
                        <th class="left_table"> 
                        <label for="unit_nr">{{ __('users.attributes.unit_nr') }}</label>
                        </th>
                        <th class="right_table">
                        <x-wireui-input placeholder="" wire:model="unit_nr" />
                        </th>
                    </tr>

                    <tr>
                        <th class="left_table"> 
                        <label for="post_code">{{ __('users.attributes.post_code') }}</label>
                        </th>
                        <th class="right_table">
                        <x-wireui-input placeholder="" wire:model="post_code" />
                        </th>
                    </tr>

                    <tr>
                        <th class="left_table"> 
                        <label for="password">{{ __('users.attributes.password') }}</label>
                        </th>
                        <th class="right_table">
                        <x-wireui-input placeholder="" wire:model="password" />
                        </th>
                    </tr>

                    <tr>
                        <th class="left_table"> 
                        <label for="description">{{ __('users.attributes.description') }}</label>
                        </th>
                        <th class="right_table">
                        <x-wireui-input placeholder="" wire:model="description" />
                        </th>
                    </tr>


                </table>
            </div>
            <div class="button_divbox">
            <x-wireui-button href="{{ route('users.index') }}" secondary class="mr-2"
            label="{{ __('translation.placeholder.cancel') }}" />
        <x-wireui-button type="submit" primary label="{{ __('translation.placeholder.save') }}" spinner />
            </div>
        </div>
    </div>

</form>


