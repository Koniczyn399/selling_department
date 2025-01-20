<?php

namespace App\Livewire\OrderProducts;

use App\Models\OrderProduct;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class OrderProductTable extends PowerGridComponent
{
    public string $tableName = 'order-product-table-kve15w-table';

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
        return OrderProduct::query()
              ->join('products', function ($products) {
                  $products->on('order_products.product_id', '=', 'products.id');
              })

              ->select([
                  'order_products.id',
                  'order_products.order_id',
                  'products.price as p',
                  'products.product_name',
                  'order_products.amount',

              ]);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
        ->add('id')
        ->add('order_id')
        ->add('product_name')
        ->add('amount')
        ->add('price', function ($order_product) {
            return floatval($order_product->amount * $order_product->p);
        })
        ->add('created_at')
        ->add('created_at_formatted', fn (OrderProduct $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make(__('orderproducts.attributes.order_id'), 'order_id')
            ->sortable(),

            Column::make(__('orderproducts.attributes.product_name'), 'product_name')
            ->sortable(),

            Column::make(__('orderproducts.attributes.amount'), 'amount')
            ->sortable(),

            Column::make(__('orderproducts.attributes.price'), 'price')
            ->sortable(),


            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->searchable(),

            Column::action('Action')
        ];
    }


    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    #[\Livewire\Attributes\On('removeOrderProductAction')]
    public function removeOrderProductAction($id): void
    {
        $this->authorize('delete', OrderProduct::findOrFail($id));
        OrderProduct::findOrFail($id)->delete();
    }

    public function actions(OrderProduct $orderproduct): array
    {
        return [
            Button::add('editOrderProductAction')
            ->slot(Blade::render('<x-wireui-icon name="pencil" class="w-5 h-5" mini />'))
            ->tooltip(__('orderproducts.actions.edit_orderproduct_action'))
            ->class('text-green-500')
            ->route('orderproducts.edit', [$orderproduct]),

            Button::add('removeOrderProductAction')
                ->slot(Blade::render('<x-wireui-icon name="x-mark" class="w-5 h-5" mini />'))
                ->tooltip(__('orderproducts.actions.remove_orderproduct_action'))
                ->class('text-red-500')
                ->dispatch('removeOrderProductAction', ['id' => $orderproduct->id]),
        ];
    }

    /*
    public function actionRules(OrderProduct $row): array
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
