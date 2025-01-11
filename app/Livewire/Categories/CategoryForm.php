<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use WireUi\Traits\WireUiActions;
use Livewire\Attributes\Validate;

class CategoryForm extends Component
{
    use WireUiActions;

    public Category $category;

    public $id =null;
    public $category_name = "";

    public function mount(Category $category = null){

        //dd($category);
      
        $this->category =$category;

            if (isset($category->id)) {
                $this->id = $category->id;
                $this->category_name = $category->category_name;
            }
        
    }

    public function submit()
    {
        if (isset($this->category->id)) {
            $this->authorize('update', $this->category);
        } else {
            $this->authorize('create', Category::class);
        }

        Category::updateOrCreate(
            ['id' => $this->id],
            $this->validate()
        );

        


        return $this->redirect(route('categories.index'));
    }

    public function rules()
    {
        return [
            'category_name' => [
                'required',
                'string',
                'min:2',
                'unique:categories,category_name'.
                    (isset($this->category->id) ? (','.$this->category->id) : ''),
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'category_name' => Str::lower(__('categories.attributes.category_name')),
        ];
    }



    public function render()
    {
        return view('livewire.categories.category-form');
    }
}
