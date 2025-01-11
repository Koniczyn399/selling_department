<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Str;
use WireUi\Traits\WireUiActions;

class OrderForm extends Component
{

    use WireUiActions;

    public Order $order;

    public $users;
    public $orderstates;
    
    public $id =null;
    public $client_id = "";
    public $worker_id = "";
    public $order_state_id = "";
    public $deadline_of_completion = "";
    public $date_of_completion="";
    public $price = "";
    public $description = "";

    public function mount(Order $order = null, $users, $orderstates){

        
      
        $this->order =$order;
        $this->users =$users;
        $this->orderstates =$orderstates;


            if (isset($order->id)) {
                $this->id = $order->id;
                $this->client_id = $order->client_id;
                $this->worker_id = $order->worker_id;
                $this->order_state_id = $order->order_state_id;
                $this->deadline_of_completion = $order->deadline_of_completion;
                $this->date_of_completion = $order->date_of_completion;
                $this->price = $order->price;
                $this->description = $order->description;
            }
        //dd($order);
    }

    public function submit()
    {
        if (isset($this->order->id)) {
            $this->authorize('update', $this->order);
        } else {
            $this->authorize('create', Order::class);
        }

        Order::updateOrCreate(
            ['id' => $this->id],
            $this->validate()
        );


        return $this->redirect(route('orders.index'));
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
            'order_state_id' => [
                'required',
                'integer',
            ],

            'deadline_of_completion' => [
                'date',

            ],

            'date_of_completion' => [
                'date',

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
            'order_state_name' => Str::lower(__('orderstates.attributes.order_state_name')),
        ];
    }
    public function render()
    {
        return view('livewire.orders.order-form');
    }
}
