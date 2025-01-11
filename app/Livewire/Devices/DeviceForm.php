<?php

namespace App\Livewire\Devices;

use App\Models\Device;
use Livewire\Component;
use Illuminate\Support\Str;
use WireUi\Traits\WireUiActions;

class DeviceForm extends Component
{
    use WireUiActions;

    public Device $device;
    
    public $id =null;
    public $brand = "";
    public $model = "";
    public $description = "";

    public function mount(Device $device = null){

        //dd($category);
      
        $this->device =$device;

            if (isset($device->id)) {
                $this->id = $device->id;
                $this->brand = $device->brand;
                $this->model = $device->model;
                $this->description = $device->description;
            }
        
    }

    public function submit()
    {
        if (isset($this->device->id)) {
            $this->authorize('update', $this->device);
        } else {
            $this->authorize('create', Device::class);
        }

        Device::updateOrCreate(
            ['id' => $this->id],
            $this->validate()
        );


        return $this->redirect(route('devices.index'));
    }

    public function rules()
    {
        return [
            'brand' => [
                'required',
                'string',
                'min:2',
            ],
            'model' => [
                'required',
                'string',
                'min:2',
                'unique:devices,Model'.
                (isset($this->device->id) ? (','.$this->device->id) : ''),
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
            'brand' => Str::lower(__('devices.attributes.brand')),
            'model' => Str::lower(__('devices.attributes.model')),
            'description' => Str::lower(__('devices.attributes.description')),
        ];
    }
    public function render()
    {
        return view('livewire.devices.device-form');
    }
}
