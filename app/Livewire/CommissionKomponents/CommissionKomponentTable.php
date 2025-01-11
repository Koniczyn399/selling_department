<?php

namespace App\Livewire\CommissionKomponents;

use Illuminate\Support\Carbon;
use App\Models\CommissionKomponent;
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

final class CommissionKomponentTable extends PowerGridComponent
{
    use AuthorizesRequests;
    public string $tableName = 'commission-komponent-table-umkeex-table';

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
        return CommissionKomponent::query()

              ->join('products', function ($products) {
                  $products->on('commission_komponents.product_id', '=', 'products.id');
              })
              ->select([
                  'commission_komponents.id',
                  'products.product_name',

                'commission_komponents.commission_id',
                'commission_komponents.price',
                'commission_komponents.amount',
                'commission_komponents.description',

              ]);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
        ->add('id')
        ->add('commission_id')
        ->add('product_name')
        ->add('amount')
        ->add('price')
        ->add('description')
        ->add('created_at')
        ->add('created_at_formatted', fn(CommissionKomponent $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            
            Column::make(__('commissionkomponents.attributes.commission_komponent_id'), 'id'),

            Column::make(__('commissionkomponents.attributes.commission_id'), 'commission_id'),


            Column::make(__('commissionkomponents.attributes.product_name'), 'product_name'),


            Column::make(__('commissionkomponents.attributes.amount'), 'amount'),
            Column::make(__('commissionkomponents.attributes.price'), 'price'),
            Column::make(__('commissionkomponents.attributes.description'), 'description'),

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

    #[\Livewire\Attributes\On('removeCommissionKomponentAction')]
    public function removeCommissionKomponentAction($id): void
    {
        $this->authorize('delete', CommissionKomponent::findOrFail($id));
        CommissionKomponent::findOrFail($id)->delete();
    }

    public function actions(CommissionKomponent $commissionkomponent): array
    {
        return [
            Button::add('editCommissionAction')
                ->slot(Blade::render('<x-wireui-icon name="pencil" class="w-5 h-5" mini />'))
                ->tooltip(__('commissionkomponents.actions.edit_commissionkomponent_action'))
                ->class('text-green-500')
                ->route('commissionkomponents.edit', [$commissionkomponent]),

            Button::add('removeCommissionKomponentAction')
                ->slot(Blade::render('<x-wireui-icon name="x-mark" class="w-5 h-5" mini />'))
                ->tooltip(__('commissionkomponents.actions.remove_commissionkomponent_action'))
                ->class('text-red-500')
                ->dispatch('removeCommissionKomponentAction', ['id' => $commissionkomponent->id]),
        ];
    }

    /*
    public function actionRules(CommissionKomponent $row): array
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
