<?php

namespace App\Livewire\Devices;

use App\Models\Device;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class DeviceTable extends PowerGridComponent
{
    public string $tableName = 'device-table-sodief-table';

    public function setUp(): array
    {
        //$this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Device::query();
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
        ->add('id')
        ->add('brand')
        ->add('model')
        ->add('description')
            ->add('created_at')
            ->add('created_at_formatted', fn (Device $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make(__('devices.attributes.device_id'), 'id'),

            Column::make(__('devices.attributes.brand'), 'brand')
                ->sortable()
                ->searchable(),

            Column::make(__('devices.attributes.model'), 'model')
                ->sortable()
                ->searchable(),

            Column::make(__('devices.attributes.description'), 'description')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->hidden(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->searchable(),

            Column::action(__('translation.attributes.actions')),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('name'),
            Filter::datepicker('created_at_formatted', 'created_at'),
        ];
    }


    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    #[\Livewire\Attributes\On('removeDeviceAction')]
    public function removeCategoryAction($id): void
    {
        $this->authorize('delete', Device::findOrFail($id));
        Device::findOrFail($id)->delete();
    }



    public function actions(Device $device): array
    {

        return [
            Button::add('editDeviceAction')

                ->slot(Blade::render('<x-wireui-icon name="pencil" class="w-5 h-5" mini />'))
                ->tooltip(__('devices.actions.edit_device_action'))
                ->class('text-green-500')
                ->route('devices.edit', [$device]),

            Button::add('removeDeviceAction')
                ->slot(Blade::render('<x-wireui-icon name="x-mark" class="w-5 h-5" mini />'))
                ->tooltip(__('devices.actions.remove_device_action'))
                ->class('text-red-500')
                ->dispatch('removeDeviceAction', ['id' => $device->id]),
        ];
    }


    /*
    public function actionRules(Device $row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
