<?php

namespace App\Livewire\Categories;

use App\Models\User;
use App\Models\Category;
use App\Enums\Auth\RoleType;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class CategoryTable extends PowerGridComponent
{
    use AuthorizesRequests;
    use WithExport;

    public string $tableName = 'category-table-rirwqi-table';

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
        return Category::query();
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('category_name')
            ->add('created_at')
            ->add('created_at_formatted', fn(Category $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make(__('categories.attributes.category_id'), 'id'),

            Column::make(__('categories.attributes.category_name'), 'category_name')
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

    #[\Livewire\Attributes\On('removeCategoryAction')]
    public function removeCategoryAction($id): void
    {
        $this->authorize('delete', Category::findOrFail($id));
        Category::findOrFail($id)->delete();
    }



    public function actions(Category $category): array
    {

        return [
            Button::add('editCategoryAction')

                ->slot(Blade::render('<x-wireui-icon name="pencil" class="w-5 h-5" mini />'))
                ->tooltip(__('categories.actions.edit_category_action'))
                ->class('text-green-500')
                ->route('categories.edit', [$category]),

            Button::add('removeCategoryAction')
                ->slot(Blade::render('<x-wireui-icon name="x-mark" class="w-5 h-5" mini />'))
                ->tooltip(__('categories.actions.remove_category_action'))
                ->class('text-red-500')
                ->dispatch('removeCategoryAction', ['id' => $category->id]),
        ];
    }



    /*
    public function actionRules(Category $row): array
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
