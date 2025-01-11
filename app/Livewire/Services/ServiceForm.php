<?php

namespace App\Livewire\Services;

use App\Models\Service;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use WireUi\Traits\WireUiActions;

class ServiceForm extends Component
{

    use WireUiActions;

    public Service $service;
    public $categories;

    public $id =null;
    public $category_id ="";
    public $service_name = "";
    public $price = "";
    public $unit = "";
    public $description = "";

    public function mount(Service $service = null, $categories ){

        //dd($this);
      
        $this->service =$service;
        $this->categories =$categories;

            if (isset($service->id)) {
                $this->id = $service->id;
                $this->category_id = $service->category_id;
                $this->service_name = $service->service_name;
                $this->price = $service->price;
                $this->unit = $service->unit;
                $this->description = $service->description;
            }
            //dd($this);
    }

    public function submit()
    {
       //dd($this);
        if (isset($this->service->id)) {
            $this->authorize('update', $this->service);
        } else {
            $this->authorize('create', Service::class);
        }

        

  

        Service::updateOrCreate(
            ['id' => $this->id],
            $this->validate()
        );

        flash(
            isset($this->service->id)
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            isset($this->service->id)
                ? __('services.messages.successes.updated', ['name' => $this->service_name])
                : __('services.messages.successes.stored', ['name' => $this->service_name]),
            'success'
        );

        return $this->redirect(route('services.index'));
    }

    public function rules()
    {
        return [
            'category_id' => [
                'required',
                'integer',
                //'exists:categories,id'
            ],
            'service_name' => [
                'required',
                'string',
                'min:2',
                'unique:services,service_name'.
                    (isset($this->service->id) ? (','.$this->service->id) : ''),
            ],

            'price' => [
                'required',
                'numeric',
                'gt:0',
                'max:10000',
            ],
            'unit' => [
                'required',
                'string',
                'min:2',
            ],
            'description' => [
                'required',
                'string',
                'min:2',
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'category_id' => Str::lower(__('services.attributes.category_id')),
            'service_name' => Str::lower(__('services.attributes.service_name')),
            'price' => Str::lower(__('services.attributes.price')),
            'unit' => Str::lower(__('services.attributes.unit')),
            'description' => Str::lower(__('services.attributes.description')),
        ];
    }

    public function render()
    {
        return view('livewire.services.service-form');
    }
}
