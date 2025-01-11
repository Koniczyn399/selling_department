<?php

namespace App\Livewire\CommissionKomponents;

use Livewire\Component;
use Illuminate\Support\Str;
use WireUi\Traits\WireUiActions;
use App\Models\CommissionKomponent;

class CommissionKomponentForm extends Component
{

    use WireUiActions;

    public CommissionKomponent $commissionkomponent;
    
    public $commissions;
    public $products;
    public $id =null;
    public $commission_id = "";
    public $product_id = "";
    public $amount = "";
    public $price = "";
    public $description = "";


    public function mount(CommissionKomponent $commissionkomponent = null, $commissions, $products){

       
      
        $this->commissionkomponent = $commissionkomponent;
        $this->commissions =$commissions;
        $this->products =$products;

            if (isset($commissionkomponent->id)) {
                $this->id = $commissionkomponent->id;
                $this->commission_id = $commissionkomponent->commission_id;
                $this->product_id = $commissionkomponent->product_id;
                $this->amount = $commissionkomponent->amount;
                $this->price = $commissionkomponent->price;
                $this->description = $commissionkomponent->description;
            }

        //dd($commissionkomponent);
        
    }

    public function submit()
    {
        if (isset($this->commissionkomponent->id)) {
            $this->authorize('update', $this->commissionkomponent);
        } else {
            $this->authorize('create', CommissionKomponent::class);
        }

        CommissionKomponent::updateOrCreate(
            ['id' => $this->id],
            $this->validate()
        );

        


        return $this->redirect(route('commissionkomponents.index'));
    }

    public function rules()
    {
        return [
            'commission_id' => [
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
            'category_name' => Str::lower(__('categories.attributes.category_name')),
        ];
    }



    public function render()
    {
        return view('livewire.commission-komponents.commission-komponent-form');
    }
}
