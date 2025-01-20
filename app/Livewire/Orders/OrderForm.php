<?php

namespace App\Livewire\Orders;

use App\Models\User;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Str;
use WireUi\Traits\WireUiActions;


class OrderForm extends Component
{

    use WireUiActions;


    public Order $order;
    public $users;
    public $sellers;

    
    public $id =null;
    public $client_id = "";
    public $seller_id = "";
    public $date_of_order="";



    public function mount(Order $order = null, $users){

        $this->order =$order;
        $this->users =$users;
        $this->sellers=User::query()->where('users.position','!=',null)->get();
        

            if (isset($order)) {
                $this->id = $order->id;
                $this->client_id = $order->client_id;
                $this->seller_id = $order->seller_id;
                $this->date_of_order = $order->date_of_order;
              
            }

    }

    

    public function submit()
    {

        if (isset($this->order->id)) {
            $this->authorize('update', $this->order);
        } else {
            $this->authorize('create', Order::class);
        }

        $object=Order::updateOrCreate(
            ['id' => $this->id],
            $this->validate()
        );
        $new_id= $object->id;


        $this->dialog()->confirm([
            'title' => __('orders.dialogs.products_question.title'),
            'description' => __('orders.dialogs.products_question.description', [
                'name' => $new_id,
            ]),
            'icon' => 'question',
            'accept' => [
                'label' => __('translation.dialogs.yes'),
                'method' => 'create',
                'params' => $new_id,
            ],
            'reject' => [
                'label' => __('translation.dialogs.no'),
                'method' => 'index',
            ],
        ]);
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
            'client_id' => [
                'required',
                'integer',
            ],
            'seller_id' => [
                'required',
                'integer',
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
