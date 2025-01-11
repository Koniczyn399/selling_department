<?php

namespace App\Livewire\Commissions;

use Livewire\Component;
use App\Models\Commission;
use Illuminate\Support\Str;
use WireUi\Traits\WireUiActions;

class CommissionForm extends Component
{

    use WireUiActions;

    public Commission $commission;
    public $users;
    public $services;

    public $id = null;
    public $client_id = "";
    public $worker_id = "";
    public $device_imei = "";
    public $device_sn = "";
    public $deadline_of_completion = "";
    public $date_of_completion = "";
    public $service_id = "";
    public $description = "";

    public function mount(Commission $commission = null, $users, $services)
    {

        $this->commission = $commission;
        $this->users = $users;
        $this->services = $services;

        if (isset($commission->id)) {
            $this->id = $commission->id;
            $this->client_id = $commission->client_id;
            $this->worker_id = $commission->worker_id;
            $this->device_imei = $commission->device_imei;
            $this->device_sn = $commission->device_sn;
            $this->deadline_of_completion = $commission->deadline_of_completion;
            $this->date_of_completion = $commission->date_of_completion;
            $this->service_id = $commission->service_id;
            $this->description = $commission->description;
        }

        //dd($this);

    }

    public function submit()
    {
        //dd($this);
        if (isset($this->service->id)) {
            $this->authorize('update', $this->service);
        } else {
            $this->authorize('create', Commission::class);
        }


        Commission::updateOrCreate(
            ['id' => $this->id],
            $this->validate()
        );

        flash(
            isset($this->commission->id)
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            isset($this->commission->id)
                ? __('commissions.messages.successes.updated', ['name' => $this->id])
                : __('commissions.messages.successes.stored', ['name' => $this->id]),
            'success'
        );

        return $this->redirect(route('commissions.index'));
    }

    public function rules()
    {
        return [
            'client_id' => [
                'required',
                'integer',
            ],
            'worker_id' => [
                'required',
                'integer',
            ],


            'device_imei' => [
                'required',
                'numeric',
                'gt:0',

            ],

            'device_sn' => [
                'required',
                'numeric',
                'gt:0',

            ],
            'deadline_of_completion' => [
                'date',

            ],

            'date_of_completion' => [
                'date',

            ],

            'service_id' => [
                'required',
                'integer',
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
            'client_id' => Str::lower(__('services.attributes.client_id')),
            'worker_id' => Str::lower(__('services.attributes.worker_id')),
            'device_imei' => Str::lower(__('services.attributes.device_imei')),
            'device_sn' => Str::lower(__('services.attributes.sn')),
            'deadline_of_completion' => Str::lower(__('services.attributes.deadline_of_completion')),
            'date_of_completion' => Str::lower(__('services.attributes.date_of_completion')),
            'service_id' => Str::lower(__('services.attributes.service_id')),
            'description' => Str::lower(__('services.attributes.description')),
        ];
    }
    public function render()
    {
        return view('livewire.commissions.commission-form');
    }
}
