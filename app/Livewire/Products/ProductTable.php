<?php

namespace App\Livewire\Products;


use App\Models\Product;
use Illuminate\Support\Carbon;
use WireUi\Traits\WireUiActions;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;


final class ProductTable extends PowerGridComponent
{
    use AuthorizesRequests;
    use WireUiActions;
    public string $tableName = 'product-table-h7dwag-table';

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
        return Product::query()
            ->join('categories', function ($categories) {
                $categories->on('products.category_id', '=', 'categories.id');
            })
            ->join('manufacturers', function ($manufacturers) {
                $manufacturers->on('products.manufacturer_id', '=', 'manufacturers.id');
            })
            ->select([
                'products.id',
                'categories.category_name',
                'products.product_name',
                'products.price',
                'products.unit',
                'products.amount',
                'products.description',
                'manufacturers.manufacturer_name',
            ]);
    }

    public function relationSearch(): array
    {
        return [
            'categories' => 'category_name',
            'manufacturers' => 'manufacturer_name',
        ];
    }


    public function fields(): PowerGridFields
    {


        return PowerGrid::fields()
            ->add('id')
            ->add('category_name')
            ->add('manufacturer_name')
            ->add('product_name')
            ->add('price')
            ->add('unit')
            ->add('amount')
            ->add('description')
            ->add('created_at')
            ->add('created_at_formatted', fn(Product $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {

        return [
            Column::make(__('products.attributes.product_id'), 'id')
                ->sortable(),

            Column::make(__('categories.attributes.category_name'), 'category_name')
                ->sortable()
                ->searchable(),
            Column::make(__('manufacturers.attributes.manufacturer_name'), 'manufacturer_name')
                ->sortable(),

            Column::make(__('products.attributes.product_name'), 'product_name'),
            Column::make(__('products.attributes.price'), 'price'),
            Column::make(__('products.attributes.unit'), 'unit'),
            Column::make(__('products.attributes.amount'), 'amount'),
            Column::make(__('products.attributes.description'), 'description'),

            Column::make('Created at', 'created_at')
                ->hidden(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->searchable(),

            Column::action('Action')
        ];
    }


    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    #[\Livewire\Attributes\On('removeProductAction')]
    public function removeProductAction($id): void
    {
        $this->authorize('delete', Product::findOrFail($id));
        Product::findOrFail($id)->delete();
    }

    public function actions(Product $product): array
    {
        return [
            Button::add('editCommissionAction')
                ->slot(Blade::render('<x-wireui-icon name="pencil" class="w-5 h-5" mini />'))
                ->tooltip(__('products.actions.edit_product_action'))
                ->class('text-green-500')
                ->route('products.edit', [$product]),

            Button::add('removeProductAction')
                ->slot(Blade::render('<x-wireui-icon name="x-mark" class="w-5 h-5" mini />'))
                ->tooltip(__('products.actions.remove_product_action'))
                ->class('text-red-500')
                ->dispatch('removeProductAction', ['id' => $product->id]),
        ];
    }

    /*
    public function actionRules(Product $row): array
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
