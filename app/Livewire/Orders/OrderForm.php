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
    public $products;
    
    public $id =null;
    public $client_id = "";
    public $seller_id = "";

    public $product_ids = [];
    public $date_of_order="";


    public function mount(Order $order = null, $users, $products){

        
      
        $this->order =$order;
        $this->users =$users;
        $this->products =$products;


            if (isset($order->id)) {
                $this->id = $order->id;
                $this->client_id = $order->client_id;
                $this->seller_id = $order->seller_id;


                $this->date_of_order = $order->date_of_order;
                $this->product_ids = $order->products->pluck('id')->toArray();
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


            'product_ids' => [
                'required',
                'array',
            ],

            'date_of_order' => [
                'date',

            ],


        ];
    }

    public function validationAttributes()
    {
        return [
            'date_of_order' => Str::lower(__('orders.attributes.date_of_order')),
        ];
    }
    public function render()
    {
        return view('livewire.orders.order-form');
    }
}
