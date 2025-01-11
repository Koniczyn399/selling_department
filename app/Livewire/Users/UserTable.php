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
        return User::query()->with('roles');
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
            ->add('email')
            ->add('created_at')
            ->add('created_at_formatted', function ($user) {
                return Carbon::parse($user->created_at)->format('Y-m-d H:i');
            })
            ->add('verified_at')
            ->add('verified_at_formatted', function ($user) {
                return Carbon::parse($user->email_verified_at)->format('Y-m-d H:i');
            })
            ->add('joined_roles', function ($user) {
                return $user->roles->pluck('name')
                    ->map(function ($roleName) {
                        return __('translation.roles.' . $roleName);
                    })->join(', ');
            });
    }

    public function columns(): array
    {
        return [
            Column::make(__('users.attributes.id'), 'id'),
            Column::make(__('users.attributes.name'), 'name')
                ->sortable()
                ->searchable(),

            Column::make(__('users.attributes.email'), 'email')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable()
                ->searchable(),

            Column::make('Verified at', 'verified_at_formatted', 'email_verified_at')
                ->sortable()
                ->searchable(),

            Column::make(__('users.attributes.roles'), 'joined_roles'),

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

    #[\Livewire\Attributes\On('assignAdminRoleAction')]
    public function assignAdminRoleAction($id): void
    {
        $this->authorize('update', Auth::user());
        User::findOrFail($id)->assignRole(RoleType::ADMIN->value);
    }

    #[\Livewire\Attributes\On('removeAdminRoleAction')]
    public function removeAdminRoleAction($id): void
    {
        $this->authorize('update', Auth::user());
        User::findOrFail($id)->removeRole(RoleType::ADMIN->value);
    }

    #[\Livewire\Attributes\On('assignWorkerRoleAction')]
    public function assignWorkerRoleAction($id): void
    {
        $this->authorize('update', Auth::user());
        User::findOrFail($id)->assignRole(RoleType::WORKER->value);
    }

    #[\Livewire\Attributes\On('removeWorkerRoleAction')]
    public function removeWorkerRoleAction($id): void
    {
        $this->authorize('update', Auth::user());
        User::findOrFail($id)->removeRole(RoleType::WORKER->value);
    }
    public function actions(User $user): array
    {
        return [
            Button::add('assignAdminRoleAction')
                ->slot(Blade::render('<x-wireui-icon name="shield-check" class="w-5 h-5" mini />'))
                ->tooltip(__('users.actions.assign_admin_role'))
                ->class('text-gray-500')
                ->dispatch('assignAdminRoleAction', ['id' => $user->id]),
            Button::add('removeAdminRoleAction')
                ->slot(Blade::render('<x-wireui-icon name="shield-check" class="w-5 h-5" mini />'))
                ->tooltip(__('users.actions.remove_admin_role'))
                ->class('text-green-500')
                ->dispatch('removeAdminRoleAction', ['id' => $user->id]),
            Button::add('assignWorkerRoleAction')
                ->slot(Blade::render('<x-wireui-icon name="cube" class="w-5 h-5" mini />'))
                ->tooltip(__('users.actions.assign_worker_role'))
                ->class('text-gray-500')
                ->dispatch('assignWorkerRoleAction', ['id' => $user->id]),
            Button::add('removeWorkerRoleAction')
                ->slot(Blade::render('<x-wireui-icon name="cube" class="w-5 h-5" mini />'))
                ->tooltip(__('users.actions.remove_worker_role'))
                ->class('text-green-500')
                ->dispatch('removeWorkerRoleAction', ['id' => $user->id]),
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
