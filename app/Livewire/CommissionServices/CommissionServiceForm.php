<?php

namespace App\Livewire\CommissionServices;

use Livewire\Component;
use Illuminate\Support\Str;
use WireUi\Traits\WireUiActions;
use App\Models\CommissionService;

class CommissionServiceForm extends Component
{
    use WireUiActions;

    public CommissionService $commissionservice;
    public $commissions;
    public $services;

    public $id =null;
    public $commission_id = "";
    public $service_id = "";
    public $amount = "";
    public $price = "";
    public $description = "";

    public function mount(CommissionService $commissionservice = null, $commissions, $services ){

       
      
        $this->commissionservice = $commissionservice;
        $this->commissions = $commissions;
        $this->services = $services;

            if (isset($commissionservice->id)) {
                $this->id = $commissionservice->id;
                $this->commission_id = $commissionservice->commission_id;
                $this->service_id = $commissionservice->service_id;
                $this->amount = $commissionservice->amount;
                $this->price = $commissionservice->price;
                $this->description = $commissionservice->description;
            }

            //dd($this);
        
    }

    public function submit()
    {
       //dd($this);
        if (isset($this->commissionservice->id)) {
            $this->authorize('update', $this->commissionservice);
        } else {
            $this->authorize('create', CommissionService::class);
        }


        CommissionService::updateOrCreate(
            ['id' => $this->id],
            $this->validate()
        );

        flash(
            isset($this->commissionservice->id)
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            isset($this->commissionservice->id)
                ? __('commissions.messages.successes.updated', ['name' => $this->id])
                : __('commissions.messages.successes.stored', ['name' => $this->id]),
            'success'
        );

        return $this->redirect(route('commissionservices.index'));
    }

    public function rules()
    {
        return [
            'commission_id' => [
                'required',
                'integer',
            ],
            'service_id' => [
                'required',
                'integer',
            ],

            'amount' => [
                'required',
                'string',
                'min:1',
            ],

            'price' => [
                'required',
                'numeric',
                'gt:0',
                'max:10000',
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
            'service_id' => Str::lower(__('services.attributes.service_id')),
            'description' => Str::lower(__('services.attributes.description')),
        ];
    }
    public function render()
    {
        return view('livewire.commission-services.commission-service-form');
    }
}
