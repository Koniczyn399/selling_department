<?php

namespace App\Livewire\Employees;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class EmployeeTable extends PowerGridComponent
{
    public string $tableName = 'employee-table-egby4x-table';

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
        return User::query()->where('users.position','!=',null);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('last_name')
            ->add('nip')
            ->add('position');
    }

    public function columns(): array
    {
        return [
            Column::make(__('employees.attributes.id'), 'id'),
            Column::make(__('employees.attributes.name'), 'name')
                ->sortable()
                ->searchable(),

            Column::make(__('employees.attributes.last_name'), 'last_name')
                ->sortable()
                ->searchable(),

            Column::make(__('employees.attributes.nip'), 'nip')
                ->sortable()
                ->searchable(),

            Column::make(__('employees.attributes.position'), 'position')
                ->sortable()
                ->searchable(),

            Column::action('')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('remove_employee')]
    public function remove_user($id): void
    {
        $this->authorize('delete', User::findOrFail($id));
        User::findOrFail($id)->delete();
    }

    public function actions(User $employee): array
    {
    
        return [
            Button::add('show_employee')
            ->slot(Blade::render('<x-wireui-icon name="eye" class="w-5 h-5" mini />'))
            ->tooltip(__('employees.actions.show_employees'))
            ->class('text-green-500')
            ->route('employees.show', [$employee]),

    
        Button::add('edit_employee')
            ->slot(Blade::render('<x-wireui-icon name="pencil" class="w-5 h-5" mini />'))
            ->tooltip(__('users.actions.edit_employee'))
            ->class('text-yellow-500')
            ->route('employees.edit', [$employee]),

        Button::add('remove_employee')
            ->slot(Blade::render('<x-wireui-icon name="x-mark"  class="w-5 x h-5" mini />'))
            ->tooltip(__('users.actions.remove_employee'))
            ->class('text-red-500')
            ->dispatch('remove_employee', ['id' => $employee->id]),
        
        ];
    }

    /*
    public function actionRules($row): array
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
