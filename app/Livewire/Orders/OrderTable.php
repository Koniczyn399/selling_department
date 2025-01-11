<?php

namespace App\Livewire\Orders;

use App\Models\Order;
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

final class OrderTable extends PowerGridComponent
{
    public string $tableName = 'order-table-sxiwse-table';

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
        return Order::query()
        ->join('users as workers', function ($users) {
            $users->on('orders.worker_id', '=', 'workers.id');
        })
        ->join('users as clients', function ($users) {
            $users->on('orders.client_id', '=', 'clients.id');
        })
          ->join('order_states', function ($order_states) {
            $order_states->on('orders.order_state_id', '=', 'order_states.id');
        })

          ->select([
            'orders.id',
            'orders.worker_id',
            'workers.name as worker_name',
            'clients.name as client_name',
            'order_states.order_state_name',

            'orders.price',
            'orders.deadline_of_completion',
            'orders.date_of_completion',
            'orders.description',

          ]);
    }

    
    public function relationSearch(): array
    {
        return [
            'users' => 'name',
            //'order_states' => 'order_state_name',
        ];
    }

    protected function queryString(): array
    {
        return $this->powerGridQueryString();
    }


    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
        ->add('id')
        ->add('worker_name')
        ->add('client_name')
        ->add('order_state_name')
        ->add('deadline_of_completion')
        ->add('date_of_completion')
        ->add('price')
        ->add('description')
        ->add('created_at')
        ->add('created_at_formatted', fn(Order $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make(__('orders.attributes.order_id'), 'id'),
            Column::make(__('orders.attributes.client_name'), 'client_name'),

            Column::make(__('orders.attributes.worker_name'), 'worker_name'),

            Column::make(__('orders.attributes.order_state_name'), 'order_state_name'),

            Column::make(__('commissions.attributes.deadline_of_completion'), 'deadline_of_completion')
                ->hidden(),

            Column::make(__('commissions.attributes.deadline_of_completion'), 'deadline_of_completion', 'deadline_of_completion')
                ->searchable(),

            Column::make(__('commissions.attributes.date_of_completion'), 'date_of_completion')
                ->hidden(),

            Column::make(__('commissions.attributes.date_of_completion'), 'date_of_completion', 'date_of_completion')
                ->searchable(),


            Column::make(__('orders.attributes.price'), 'price'),

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

    #[\Livewire\Attributes\On('removeOrderAction')]
    public function removeCategoryAction($id): void
    {
        $this->authorize('delete', Order::findOrFail($id));
        Order::findOrFail($id)->delete();
    }


    public function actions(Order $order): array
    {
        return [
    
            Button::add('showOrderDetailAction')
                ->slot(Blade::render('<x-wireui-icon name="pencil" class="w-5 h-5" mini />'))
                ->tooltip(__('orders.actions.show_order_detail_action'))
                ->class('text-green-500')
                ->route('orders.show', [$order]),

            Button::add('editOrderAction')
                ->slot(Blade::render('<x-wireui-icon name="pencil" class="w-5 h-5" mini />'))
                ->tooltip(__('orders.actions.edit_order_action'))
                ->class('text-yellow-500')
                //->can($this->authorize('create', Order::class))
                ->route('orders.edit', [$order]),

            Button::add('removeOrderAction')
                ->slot(Blade::render('<x-wireui-icon name="x-mark" class="w-5 h-5" mini />'))
                ->tooltip(__('orders.actions.remove_order_action'))
                ->class('text-red-500')
                ->dispatch('removeOrderAction', ['id' => $order->id]),
        ];
    }

    /*
    public function actionRules(Order $row): array
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
