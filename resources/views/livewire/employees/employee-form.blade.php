
<form wire:submit.prevent="submit">
    <div class="content">   
        <div class="table_div">
            <h3 class="imie">
            <br>
                @if (isset($id))
                {{ __('employees.labels.edit_form_title') }}
                @else
                    {{ __('employees.labels.create_form_title') }}
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
                        <label for="nip">{{ __('users.attributes.nip') }}</label>
                        </th>
                        <th class="right_table">
                        <x-wireui-input placeholder="" wire:model="nip" />
                        </th>
                    </tr>


                    <tr>
                        <th class="left_table"> 
                        <label for="position">{{ __('employees.attributes.position') }}</label>
                        </th>
                        <th class="right_table">
                        <x-wireui-input placeholder="" wire:model="position" />
                        </th>
                    </tr>


                </table>
            </div>
            <div class="button_divbox">
            <x-wireui-button href="{{ route('employees.index') }}" secondary class="mr-2"
            label="{{ __('translation.placeholder.cancel') }}" />
        <x-wireui-button type="submit" primary label="{{ __('translation.placeholder.save') }}" spinner />
            </div>
        </div>
    </div>

</form>


