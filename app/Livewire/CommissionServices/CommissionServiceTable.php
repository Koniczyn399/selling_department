<?php

namespace App\Livewire\CommissionServices;

use Illuminate\Support\Carbon;
use App\Models\CommissionService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class CommissionServiceTable extends PowerGridComponent
{
    public string $tableName = 'commission-service-table-xlywvy-table';

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
        return CommissionService::query()
        ->join('services', function ($services) {
            $services->on('commission_services.service_id', '=', 'services.id');
        })
          ->select([
            'commission_services.id',
            'commission_services.commission_id',
            'services.service_name',
            'commission_services.amount',
            'commission_services.price',
            'commission_services.description',

          ]);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
        ->add('id')
        ->add('commission_id')
        ->add('service_name')
        ->add('amount')
        ->add('price')
        ->add('description')
        ->add('created_at')
        ->add('created_at_formatted', fn(CommissionService $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make(__('commissionservices.attributes.ID'), 'id'),
            Column::make(__('commissionservices.attributes.commission_id'), 'commission_id'),
            Column::make(__('commissionservices.attributes.service_name'), 'service_name'),
            Column::make(__('commissionservices.attributes.amount'), 'amount'),
            Column::make(__('commissionservices.attributes.price'), 'price'),
            Column::make(__('commissionservices.attributes.description'), 'description'),

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
        $this->js('alert('.$rowId.')');
    }

    #[\Livewire\Attributes\On('removeCommissionServiceAction')]
    public function removeCommissionServiceAction($id): void
    {
        $this->authorize('delete', CommissionService::findOrFail($id));
        CommissionService::findOrFail($id)->delete();
    }

    public function actions(CommissionService $commissionservice): array
    {
        return [
            /*
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
            */

            Button::add('editCommissionServiceAction')
            ->slot(Blade::render('<x-wireui-icon name="pencil" class="w-5 h-5" mini />'))
            ->tooltip(__('commissionservices.actions.edit_commissionservice_action'))
            ->class('text-green-500')
            ->route('commissionservices.edit', [$commissionservice]),

            Button::add('removeCommissionServiceAction')
                ->slot(Blade::render('<x-wireui-icon name="x-mark" class="w-5 h-5" mini />'))
                ->tooltip(__('commissionservices.actions.remove_commissionservice_action'))
                ->class('text-red-500')
                ->dispatch('removeCommissionServiceAction', ['id' => $commissionservice->id]),

        ];
    }

    /*
    public function actionRules(CommissionService $row): array
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
