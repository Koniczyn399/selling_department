<?php

namespace App\Livewire\OrderStates;

use Livewire\Component;
use App\Models\OrderState;
use Illuminate\Support\Str;
use WireUi\Traits\WireUiActions;

class OrderStateForm extends Component
{
    use WireUiActions;

    public OrderState $orderstate;
    
    public $id =null;
    public $order_state_name = "";

    public function mount(OrderState $orderstate = null){

        //dd($orderstate);
      
        $this->orderstate =$orderstate;

            if (isset($orderstate->id)) {
                $this->id = $orderstate->id;
                $this->order_state_name = $orderstate->order_state_name;
            }
        
    }

    public function submit()
    {
        if (isset($this->orderstate->id)) {
            $this->authorize('update', $this->orderstate);
        } else {
            $this->authorize('create', OrderState::class);
        }

        OrderState::updateOrCreate(
            ['id' => $this->id],
            $this->validate()
        );


        return $this->redirect(route('orderstates.index'));
    }

    public function rules()
    {
        return [
            'order_state_name' => [
                'required',
                'string',
                'min:2',
                'unique:order_states,order_state_name'.
                    (isset($this->orderstate->id) ? (','.$this->orderstate->id) : ''),
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'order_state_name' => Str::lower(__('orderstates.attributes.order_state_name')),
        ];
    }
    public function render()
    {
        return view('livewire.order-states.order-state-form');
    }
}
