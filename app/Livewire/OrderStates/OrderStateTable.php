<?php

namespace App\Livewire\OrderStates;

use App\Models\OrderState;
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

final class OrderStateTable extends PowerGridComponent
{
    public string $tableName = 'order-state-table-ht2t3x-table';

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
        return OrderState::query();
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
        ->add('id')
        ->add('order_state_name')
            ->add('created_at')
            ->add('created_at_formatted', fn (OrderState $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make(__('orderstates.attributes.order_state_id'), 'id'),

            Column::make(__('orderstates.attributes.order_state_name'), 'order_state_name')
                ->sortable()
                ->searchable(),

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

    #[\Livewire\Attributes\On('removeOrderStateAction')]
    public function removeOrderStateAction($id): void
    {
        $this->authorize('delete', OrderState::findOrFail($id));
        OrderState::findOrFail($id)->delete();
    }



    public function actions(OrderState $orderstate): array
    {

        return [
            Button::add('editOrderStateAction')

                ->slot(Blade::render('<x-wireui-icon name="pencil" class="w-5 h-5" mini />'))
                ->tooltip(__('orderstates.actions.edit_orderstates_action'))
                ->class('text-green-500')
                ->route('orderstates.edit', [$orderstate]),

            Button::add('removeCategoryAction')
                ->slot(Blade::render('<x-wireui-icon name="x-mark" class="w-5 h-5" mini />'))
                ->tooltip(__('orderstates.actions.remove_orderstate_action'))
                ->class('text-red-500')
                ->dispatch('removeOrderStateAction', ['id' => $orderstate->id]),
        ];
    }

    /*
    public function actionRules(OrderState $row): array
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
