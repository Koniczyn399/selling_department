<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use WireUi\Traits\WireUiActions;

class UserForm extends Component
{
    use WireUiActions;

    public User $user;

    public $id = null;
    public $name = "";
    public $email = "";
    public $last_name = "";
    public $nip = "";
    public $post_code = "";
    public $city = "";
    public $street = "";
    public $street_number = "";
    public $unit_nr ="";

    public $phone_number = "";
    public $description = "";
    public $password = "";


    public function mount(User $user = null)
    {

        //dd($manufacturer);

        $this->user = $user;


        if (isset($user->id)) {
            $this->id = $user->id;
            $this->name = $user->name;
            $this->last_name = $user->last_name;
            $this->nip = $user->nip;
            $this->post_code = $user->post_code;
            $this->street = $user->street;
            $this->city = $user->city;
            $this->street_number = $user->street_number;
            $this->unit_nr = $user->unit_nr;
            $this->phone_number = $user->phone_number;
            $this->description = $user->description;
            $this->email = $user->email;
            $this->password = $user->password;
        }
    }

    public function submit()
    {
        // if (isset($this->user->id)) {
        //     $this->authorize('update', $this->user);
        // } else {
        //     $this->authorize('create', User::class);
        // }

        User::updateOrCreate(
            ['id' => $this->id],
            $this->validate()
        );

        flash(
            isset($this->user->id)
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            isset($this->user->id)
                ? __('users.messages.successes.updated', ['name' => $this->last_name])
                : __('users.messages.successes.stored', ['name' => $this->last_name]),
            'success'
        );


        return $this->redirect(route('users.index'));
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',

            ],

            'last_name' => [
                'required',
                'string',
                'min:2',

            ],

            'post_code' => [
                'required',
                'string',
                'min:2',

            ],

            'password' => [
                'required',
                'string',
                'min:2',

            ],

            'email' => [
                'required',
                'string',
                'min:2',

            ],

            'street' => [
                'required',
                'string',
                'min:2',

            ],


            'street_number' => [
                'required',
                'string',
                'min:1',

            ],

            'unit_nr' => [
                
                'string',
                'min:1',

            ],

            'phone_number' => [
                'required',
                'string',
                'min:2',

            ],

            'city' => [
                'required',
                'string',
                'min:2',

            ],

            'nip' => [
                'required',
                'string',
                'min:2',

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
            'name' => Str::lower(__('users.attributes.name')),
            'last_name' => Str::lower(__('users.attributes.last_name')),
        ];
    }
    public function render()
    {
        return view('livewire.users.user-form');
    }
}
