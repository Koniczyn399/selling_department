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
        return Product::query();
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
            ->add('product_name')
            ->add('description');

    }

    public function columns(): array
    {

        return [
            Column::make(__('products.attributes.product_id'), 'id')
                ->sortable(),
            Column::make(__('products.attributes.product_name'), 'product_name'),
        
            Column::make(__('products.attributes.description'), 'description'),

            Column::action(__('translation.attributes.actions')),
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
            Button::add('show_product')
            ->slot(Blade::render('<x-wireui-icon name="eye" class="w-5 h-5" mini />'))
            ->tooltip(__('products.actions.show_product'))
            ->class('text-green-500')
            ->route('products.show', [$product]),

            Button::add('editCommissionAction')
                ->slot(Blade::render('<x-wireui-icon name="pencil" class="w-5 h-5" mini />'))
                ->tooltip(__('products.actions.edit_product_action'))
                ->class('text-yellow-500')
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
