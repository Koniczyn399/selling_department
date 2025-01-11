<?php

namespace App\Livewire\OrderProducts;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use WireUi\Traits\WireUiActions;

class OrderProductForm extends Component
{
    use WireUiActions;

    public OrderProduct $orderproduct;
    public $orders;
    public $products;

    public $id =null;
    public $order_id = "";
    public $product_id = "";
    public $amount = "";
    public $price = "";
    public $description = "";

    public function mount(OrderProduct $orderproduct = null, $orders, $products ){

       
      
        $this->orderproduct = $orderproduct;
        $this->orders = $orders;
        $this->products = $products;

            if (isset($orderproduct->id)) {
                $this->id = $orderproduct->id;
                $this->order_id = $orderproduct->order_id;
                $this->product_id = $orderproduct->product_id;
                $this->amount = $orderproduct->amount;
                $this->price = $orderproduct->price;
                $this->description = $orderproduct->description;
            }

            //dd($this);
        
    }

    public function submit()
    {
       //dd($this);
        if (isset($this->service->id)) {
            $this->authorize('update', $this->service);
        } else {
            $this->authorize('create', OrderProduct::class);
        }


        OrderProduct::updateOrCreate(
            ['id' => $this->id],
            $this->validate()
        );

        flash(
            isset($this->orderproduct->id)
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            isset($this->orderproduct->id)
                ? __('commissions.messages.successes.updated', ['name' => $this->id])
                : __('commissions.messages.successes.stored', ['name' => $this->id]),
            'success'
        );

        return $this->redirect(route('orderproducts.index'));
    }

    public function rules()
    {
        return [
            'order_id' => [
                'required',
                'integer',
            ],
            'product_id' => [
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
            'description' => Str::lower(__('services.attributes.description')),
        ];
    }
    public function render()
    {
        return view('livewire.order-products.order-product-form');
    }
}
