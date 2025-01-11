<?php

namespace App\Livewire\Manufacturers;

use App\Models\Manufacturer;
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

final class ManufacturerTable extends PowerGridComponent
{
    public string $tableName = 'manufacturer-table-gjjygv-table';

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
        return Manufacturer::query();
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
        ->add('id')
        ->add('manufacturer_name')
            ->add('created_at')
            ->add('created_at_formatted', fn (Manufacturer $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make(__('manufacturers.attributes.manufacturer_id'), 'id'),

            Column::make(__('manufacturers.attributes.manufacturer_name'), 'manufacturer_name')
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

    #[\Livewire\Attributes\On('removeManufacturerAction')]
    public function removeManufacturerAction($id): void
    {
        $this->authorize('delete', Manufacturer::findOrFail($id));
        Manufacturer::findOrFail($id)->delete();
    }



    public function actions(Manufacturer $manufacturer): array
    {

        return [
            Button::add('editManufacturerAction')

                ->slot(Blade::render('<x-wireui-icon name="pencil" class="w-5 h-5" mini />'))
                ->tooltip(__('manufacturers.actions.edit_manufacturer_action'))
                ->class('text-green-500')
                ->route('manufacturers.edit', [$manufacturer]),

            Button::add('removeManufacturerAction')
                ->slot(Blade::render('<x-wireui-icon name="x-mark" class="w-5 h-5" mini />'))
                ->tooltip(__('manufacturers.actions.remove_manufacturer_action'))
                ->class('text-red-500')
                ->dispatch('removeManufacturerAction', ['id' => $manufacturer->id]),
        ];
    }







    /*
    public function actionRules(Manufacturer $row): array
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
