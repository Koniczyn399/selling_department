<?php

namespace App\Livewire\Services;

use App\Models\Service;
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

final class ServiceTable extends PowerGridComponent
{
    public string $tableName = 'service-table-cp5qdm-table';

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
        return Service::query()
              ->join('categories', function ($categories) {
                  $categories->on('services.category_id', '=', 'categories.id');
              })

              ->select([
                  'services.id',
                  'categories.category_name',
                  'services.service_name',
                  'services.price',
                  'services.unit',
                  'services.description',
              ]);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('category_name')
            ->add('service_name')
            ->add('price')
            ->add('unit')
            ->add('description')

            ->add('created_at')
            ->add('created_at_formatted', fn (Service $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

                Column::make(__('services.attributes.category_name'), 'category_name')
                ->sortable(),
    
                Column::make(__('services.attributes.service_name'), 'service_name')
                ->sortable(),
    
                Column::make(__('services.attributes.price'), 'price')
                ->sortable(),
                Column::make(__('services.attributes.unit'), 'unit')
                ->sortable(),
                Column::make(__('services.attributes.description'), 'description')
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->hidden(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->searchable(),

            Column::action('Action')
        ];
    }
/*
    public function filters(): array
    {
        return [
            Filter::inputText('name'),
            Filter::datepicker('created_at_formatted', 'created_at'),
        ];
    }
*/
    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    #[\Livewire\Attributes\On('removeServiceAction')]
    public function removeServiceAction($id): void
    {
        $this->authorize('delete', Service::findOrFail($id));
        Service::findOrFail($id)->delete();
    }



    public function actions(Service $service): array
    {

        return [
            Button::add('editServiceAction')

                ->slot(Blade::render('<x-wireui-icon name="pencil" class="w-5 h-5" mini />'))
                ->tooltip(__('services.actions.edit_service_action'))
                ->class('text-green-500')
                ->route('services.edit', [$service]),

            Button::add('removeServiceAction')
                ->slot(Blade::render('<x-wireui-icon name="x-mark" class="w-5 h-5" mini />'))
                ->tooltip(__('services.actions.remove_service_action'))
                ->class('text-red-500')
                ->dispatch('removeServiceAction', ['id' => $service->id]),
        ];
    }

    /*
    public function actionRules(Service $row): array
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
