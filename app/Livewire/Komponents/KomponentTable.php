<?php

namespace App\Livewire\Komponents;

use App\Models\Komponent;
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

final class KomponentTable extends PowerGridComponent
{

    public string $tableName = 'component-table-bzy1uw-table';

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
        return Komponent::query();
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('komponent_name')
            ->add('price')
            ->add('description')

            ->add('created_at')
            ->add('created_at_formatted', fn (Komponent $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make(__('komponents.attributes.komponent_id'), 'id'),

            Column::make(__('komponents.attributes.komponent_name'), 'komponent_name')
                ->searchable()
                ->sortable(),
            Column::make(__('komponents.attributes.price'), 'price')
                ->searchable()
                ->sortable(),

            Column::make(__('komponents.attributes.description'), 'description')
                ->searchable()
                ->sortable(),

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

    #[\Livewire\Attributes\On('removeKomponentAction')]
    public function removeKomponentAction($id): void
    {
        $this->authorize('delete', Komponent::findOrFail($id));
        Komponent::findOrFail($id)->delete();
    }
    public function actions(Komponent $komponent): array
    {

        return [
            Button::add('editKomponentAction')

                ->slot(Blade::render('<x-wireui-icon name="pencil" class="w-5 h-5" mini />'))
                ->tooltip(__('komponents.actions.edit_komponent_action'))
                ->class('text-green-500')
                ->route('komponents.edit', [$komponent]),

            Button::add('removeKomponentAction')
                ->slot(Blade::render('<x-wireui-icon name="x-mark" class="w-5 h-5" mini />'))
                ->tooltip(__('komponents.actions.remove_komponent_action'))
                ->class('text-red-500')
                ->dispatch('removeKomponentAction', ['id' => $komponent->id]),
        ];
    }








    /*
    public function actionRules(Component $row): array
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
