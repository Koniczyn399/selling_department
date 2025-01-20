<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use WireUi\Traits\WireUiActions;

class ProductForm extends Component
{


    use WireUiActions;

    public Product $product;
   
    public $id =null;

    public $product_name = "";
    public $price = "";
    public $unit = "";
    public $amount="";
    public $description="";


    public function mount(Product $product = null ){

       
      
        $this->product = $product;


            if (isset($product->id)) {
                $this->id = $product->id;

                $this->product_name = $product->product_name;
                $this->price = $product->price;
                $this->unit = $product->unit;
                $this->amount = $product->amount;
                $this->description = $product->description;
            }

            //dd($this);
        
    }

    public function submit()
    {
       //dd($this);
        if (isset($this->product->id)) {
            $this->authorize('update', $this->product);
        } else {
            $this->authorize('create', Product::class);
        }


        Product::updateOrCreate(
            ['id' => $this->id],
            $this->validate()
        );

        flash(
            isset($this->product->id)
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            isset($this->product->id)
                ? __('products.messages.successes.updated', ['name' => $this->product_name])
                : __('products.messages.successes.stored', ['name' => $this->product_name]),
            'success'
        );

        return $this->redirect(route('products.index'));
    }

    public function rules()
    {
        return [

            'product_name' => [
                'required',
                'string',
                'min:2',
            ],
            
            'price' => [
                'required',
                'string',
                'min:1',
            ],

            'unit' => [
                'required',
                'string',
                'min:1',
            ],
            'amount' => [
                'required',
                'string',
                'min:1',
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
            'product_name' => Str::lower(__('services.attributes.product_name')),

        ];
    }



    public function render()
    {
        return view('livewire.products.product-form');
    }
}
