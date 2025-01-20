<?php

namespace App\Livewire\OrderProducts;

use App\Models\Order;
use App\Models\Product;
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


    public $order_created =false;
    public $new_id =null;
 

    public function mount(OrderProduct $orderproduct = null, $new_id=null ){

        if(isset($new_id))
        {
            $this->order_id = $new_id;
            $this->order_created = true;
            $this->new_id = $new_id;
        }

        $orders = Order::query()->join('users as clients', first: function ($users) {
            $users->on('orders.client_id', '=', 'clients.id');
        })->select([
            'orders.id',
            'clients.name as client_name',
            'clients.last_name as client_last_name',
        ])->get();

        $products = Product::query()->select([
            'products.id',
            'products.product_name',
            'products.price'
        ])->get();
      
        $this->orderproduct = $orderproduct;
        $this->orders = $orders;
        $this->products = $products;
     

        if (isset($orderproduct->id)) {
            $this->id = $orderproduct->id;
            $this->order_id = $orderproduct->order_id;
            $this->product_id = $orderproduct->product_id;
            $this->amount = $orderproduct->amount;

        
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

        if($this->order_created){

            $this->dialog()->confirm([
                'title' => __('orders.dialogs.products_question.title'),
                'description' => __('orders.dialogs.products_question.second_description', [
                    'name' => $this->new_id,
                ]),
                'icon' => 'question',
                'accept' => [
                    'label' => __('translation.dialogs.yes'),
                    'method' => 'create',
                    'params' => $this->new_id,
                ],
                'reject' => [
                    'label' => __('translation.dialogs.no'),
                    'method' => 'index',
                ],
            ]);
        }

        flash(
            isset($this->orderproduct->id)
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            isset($this->orderproduct->id)
                ? __('orderproducts.messages.successes.updated', ['name' => $this->id])
                : __('orderproducts.messages.successes.stored', ['name' => $this->id]),
            'success'
        );
        return $this->redirect(route('orderproducts.index'));

       
    }

    public function index(){
        return $this->redirect(route('orders.index'));

    }

    public function create($new_id){    
        return $this->redirect(route('datas.create',['new_id'=>$new_id]));

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
        ];
    }


    public function validationAttributes()
    {
        return [
            'order_id' => Str::lower(__('services.attributes.order_id')),
        ];
    }
    public function render()
    {
        return view('livewire.order-products.order-product-form');
    }
}
