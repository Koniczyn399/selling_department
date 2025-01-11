<?php

namespace App\Livewire\Commissions;

use App\Models\User;
use App\Models\Device;
use App\Models\Service;
use App\Models\Commission;
use Illuminate\Support\Carbon;
use WireUi\Traits\WireUiActions;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class CommissionTable extends PowerGridComponent
{

    public string $tableName = 'commission-table-lad0cc-table';
    use AuthorizesRequests;
    use WireUiActions;

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
        return Commission::query()

            ->join('users as workers', function ($users) {
                $users->on('commissions.worker_id', '=', 'workers.id');
            })
            ->join('users as clients', function ($users) {
                $users->on('commissions.client_id', '=', 'clients.id');
            })
            ->join('services', function ($services) {
                $services->on('commissions.service_id', '=', 'services.id');
            })
              ->select([
                'commissions.id',
                'commissions.worker_id',
                'workers.name as worker_name',
                'clients.name as client_name',
                'services.service_name',
                'commissions.device_imei',
                'commissions.device_sn',
                'commissions.deadline_of_completion',
                'commissions.date_of_completion',
                'commissions.description',

              ]);
    }

    
    public function relationSearch(): array
    {
        return [
            //'devices' => 'model',


        ];
    }


    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
        ->add('id')
        ->add('client_id')
        ->add('client_name')
        ->add('worker_name')
        ->add('worker_id')
        ->add('device_imei')
        ->add('device_sn')
        ->add('deadline_of_completion')
        ->add('date_of_completion')
        ->add('service_name')
        ->add('description')
        ->add('created_at')
        ->add('created_at_formatted', fn(Commission $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make(__('commissions.attributes.commission_id'), 'id'),
            Column::make(__('commissions.attributes.client_name'), 'client_name'),

            Column::make(__('commissions.attributes.worker_name'), 'worker_name'),

            Column::make(__('services.attributes.service_name'), 'service_name'),

            Column::make(__('commissions.attributes.device_imei'), 'device_imei'),

            Column::make(__('commissions.attributes.device_sn'), 'device_sn'),

            Column::make(__('commissions.attributes.deadline_of_completion'), 'deadline_of_completion')
                ->hidden(),

            Column::make(__('commissions.attributes.deadline_of_completion'), 'deadline_of_completion', 'deadline_of_completion')
                ->searchable(),

            Column::make(__('commissions.attributes.date_of_completion'), 'date_of_completion')
                ->hidden(),

            Column::make(__('commissions.attributes.date_of_completion'), 'date_of_completion', 'date_of_completion')
                ->searchable(),

            Column::make(__('commissions.attributes.description'), 'description'),



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

    #[\Livewire\Attributes\On('removeCommissionAction')]
    public function removeCommissionAction($id): void
    {
        $this->authorize('delete', Commission::findOrFail($id));
        Commission::findOrFail($id)->delete();
    }


    public function actions(Commission $commission): array
    {
        return [
            Button::add('editCommissionAction')
                ->slot(Blade::render('<x-wireui-icon name="pencil" class="w-5 h-5" mini />'))
                ->tooltip(__('commissions.actions.edit_commission_action'))
                ->class('text-green-500')
                ->route('commissions.edit', ['commission' => $commission->id]),

            Button::add('removeCommissionAction')
                ->slot(Blade::render('<x-wireui-icon name="x-mark" class="w-5 h-5" mini />'))
                ->tooltip(__('commissions.actions.remove_commission_action'))
                ->class('text-red-500')
                ->dispatch('removeCommissionAction', ['id' => $commission->id]),
        ];
    }

    /*
    public function actionRules(Commission $row): array
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
