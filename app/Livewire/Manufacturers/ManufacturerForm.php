<?php

namespace App\Livewire\Manufacturers;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Manufacturer;
use WireUi\Traits\WireUiActions;


class ManufacturerForm extends Component
{
    use WireUiActions;

    public Manufacturer $manufacturer;

    public $id = null;
    public $manufacturer_name = "";

    public function mount(Manufacturer $manufacturer = null)
    {

        //dd($manufacturer);

        $this->manufacturer = $manufacturer;

        if (isset($manufacturer->id)) {
            $this->id = $manufacturer->id;
            $this->manufacturer_name = $manufacturer->manufacturer_name;
        }
    }

    public function submit()
    {
        if (isset($this->manufacturer->id)) {
            $this->authorize('update', $this->manufacturer);
        } else {
            $this->authorize('create', Manufacturer::class);
        }

        Manufacturer::updateOrCreate(
            ['id' => $this->id],
            $this->validate()
        );

        flash(
            isset($this->manufacturer->id)
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            isset($this->manufacturer->id)
                ? __('manufacturers.messages.successes.updated', ['manufacturer_name' => $this->manufacturer_name])
                : __('manufacturers.messages.successes.stored', ['manufacturer_name' => $this->manufacturer_name]),
            'success'
        );


        return $this->redirect(route('manufacturers.index'));
    }

    public function rules()
    {
        return [
            'manufacturer_name' => [
                'required',
                'string',
                'min:2',
                'unique:manufacturers,manufacturer_name' .
                    (isset($this->manufacturer->id) ? (',' . $this->manufacturer->id) : ''),
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'manufacturer_name' => Str::lower(__('manufacturers.attributes.manufacturer_name')),
        ];
    }
    public function render()
    {
        return view('livewire.manufacturers.manufacturer-form');
    }
}
