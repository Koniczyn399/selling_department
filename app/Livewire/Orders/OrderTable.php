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
        ->join('users as clients', function ($users) {
            $users->on('orders.client_id', '=', 'clients.id');
        })
          ->select([
            'orders.id',
            
            'clients.name as client_name',
            'clients.last_name as client_last_name',


            'orders.date_of_order',

          ]);
          //])->select("CONCAT(clients.name,' ',clients.last_name) as fullname");
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
        ->add('fullname', function (Order $order){
            return $order->client_name. " ".$order->client_last_name ;
        })
        ->add('date_of_order')
        ->add('joint_amount', function ($order) {
            return $order->products->pluck('price')->sum();
        });

    }

    public function columns(): array
    {
        return [
            Column::make(__('orders.attributes.order_id'), 'id'),


            Column::make(__('orders.attributes.date'), 'date_of_order')
                ->hidden(),

            Column::make(__('orders.attributes.date'), 'date_of_order', 'date_of_order'),

            
            Column::make(__('orders.attributes.joint_amount'), 'joint_amount'),


            Column::make(__('orders.attributes.client_name'), 'fullname'),


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
