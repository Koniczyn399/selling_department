<?php

namespace App\Livewire\Users;

use App\Models\User;
use App\Enums\Auth\RoleType;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;


use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;


final class UserTable extends PowerGridComponent
{
    use AuthorizesRequests;
    use WithExport;


    public string $tableName = 'user-table-vf6pfa-table';

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
        //return User::query()->whereNull('position');
        return User::query()->where('users.position','=',null);
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
            ->add('post_code')
            ->add('city')
           
            ;
    }

    public function columns(): array
    {
        return [
            Column::make(__('users.attributes.id'), 'id')
            ->sortable()
            ->searchable(),
            Column::make(__('users.attributes.name'), 'name')
                ->sortable()
                ->searchable(),

        Column::make(__('users.attributes.last_name'), 'last_name')
            ->sortable()
            ->searchable(),

            Column::make(__('users.attributes.nip'), 'nip')
            ->sortable()
            ->searchable(),

            Column::make(__('users.attributes.post_code'), 'post_code')
            ->sortable()
            ->searchable(),

            Column::make(__('users.attributes.city'), 'city')
            ->sortable()
            ->searchable(),



            Column::action(__('translation.attributes.actions')),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }


    
    #[\Livewire\Attributes\On('remove_user')]
    public function remove_user($id): void
    {
        $this->authorize('delete', User::findOrFail($id));
        User::findOrFail($id)->delete();
    }

    public function actions(User $user): array
    {
        return [
            Button::add('show_user')
            ->slot(Blade::render('<x-wireui-icon name="pencil" class="w-5 h-5" mini />'))
            ->tooltip(__('users.actions.show_user'))
            ->class('text-green-500')
            ->route('users.show', [$user]),

            Button::add('show_user_orders')
            ->slot(Blade::render('<x-wireui-icon name="eye" class="w-5 h-5" mini />'))
            ->tooltip(__('users.actions.show_user_orders'))
            ->class('text-green-500')
            ->route('users.show', ['user'=>$user, 'history'=>'true']),

        Button::add('edit_user')
            ->slot(Blade::render('<x-wireui-icon name="pencil" class="w-5 h-5" mini />'))
            ->tooltip(__('users.actions.edit_user'))
            ->class('text-yellow-500')
            //->can($this->authorize('create', Order::class))
            ->route('users.edit', [$user]),

        Button::add('remove_user')
            ->slot(Blade::render('<x-wireui-icon name="x-mark"  class="w-5 x h-5" mini />'))
            ->tooltip(__('users.actions.remove_user'))
            ->class('text-red-500')
            ->dispatch('remove_user', ['id' => $user->id]),
        ];
    }

    /*
    public function actionRules($row): array
    {
        return [
            Rule::button('assignAdminRoleAction')
                ->when(fn($user) => $user->isAdmin())
                ->hide(),
            Rule::button('removeAdminRoleAction')
                ->when(fn($user) => ! $user->isAdmin())
                ->hide(),
            Rule::button('assignWorkerRoleAction')
                ->when(fn($user) => $user->isWorker())
                ->hide(),
            Rule::button('removeWorkerRoleAction')
                ->when(fn($user) => ! $user->isWorker())
                ->hide(),
        ];
    }
        */
}
