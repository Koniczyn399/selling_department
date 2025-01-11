<?php

namespace App\Livewire\Komponents;

use Livewire\Component;
use App\Models\Komponent;
use Illuminate\Support\Str;
use WireUi\Traits\WireUiActions;

class KomponentForm extends Component
{

    use WireUiActions;

    public Komponent $komponent;

    public $id = null;
    public $komponent_name = "";
    public $price = "";
    public $description = "";

    public function mount(Komponent $komponent = null)
    {

        //dd($komponent);

        $this->komponent = $komponent;

        if (isset($komponent->id)) {
            $this->id = $komponent->id;
            $this->komponent_name = $komponent->komponent_name;
            $this->price = $komponent->price;
            $this->description = $komponent->description;
        }

    }

    public function submit()
    {
        if (isset($this->komponent->id)) {
            $this->authorize('update', $this->komponent);
        } else {
            $this->authorize('create', Komponent::class);
        }

        Komponent::updateOrCreate(
            ['id' => $this->id],
            $this->validate()
        );

        flash(
            isset($this->manufacturer->id)
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            isset($this->manufacturer->id)
                ? __('komponents.messages.successes.updated', ['name' => $this->komponent_name])
                : __('komponents.messages.successes.stored', ['name' => $this->komponent_name]),
            'success'
        );


        return $this->redirect(route('komponents.index'));
    }

    public function rules()
    {
        return [
            'komponent_name' => [
                'required',
                'string',
                'min:2',
                'unique:komponents,komponent_name' .
                    (isset($this->komponent->id) ? (','.$this->komponent->id) : ''),
            ],

            'price' => [
                'required',
                'digits_between:1,10',
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
            'komponent_name' => Str::lower(__('komponents.attributes.komponent_name')),
            'price' => Str::lower(__('komponents.attributes.price')),
            'description' => Str::lower(__('komponents.attributes.description')),
        ];
    }
    public function render()
    {
        return view('livewire.komponents.komponent-form');
    }
}
