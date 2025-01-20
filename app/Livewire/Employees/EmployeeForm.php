<?php

namespace App\Livewire\Employees;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use WireUi\Traits\WireUiActions;

class EmployeeForm extends Component
{
    use WireUiActions;

    public User $employee;

    public $id = null;
    public $name = "";
    public $email = "testowy@testowy";
    public $last_name = "";
    public $nip = "";
    public $post_code = "00-000";
    public $city = "Kalisz";
    public $street = "Kaliszowa";
    public $street_number = "0";
    public $unit_nr ="0";

    public $phone_number = "123-123-123";
    public $description = "Pracownik";
    public $position = "";


    public function mount(User $employee = null)
    {

        //dd($employee);

        $this->employee = $employee;


        $this->post_code = $employee->post_code;
        $this->street = $employee->street;
        $this->city = $employee->city;
        $this->street_number = $employee->street_number;
        $this->unit_nr = $employee->unit_nr;
        $this->phone_number = $employee->phone_number;
        $this->description = $employee->description;
        $this->email = $employee->email;

        if (isset($employee->id)) {
            $this->id = $employee->id;
            $this->name = $employee->name;
            $this->last_name = $employee->last_name;
            $this->nip = $employee->nip;
            $this->position = $employee->position;
        }
    }

    public function submit()
    {
        if (isset($this->employee->id)) {
            $this->authorize('update', $this->employee);
        } else {
            $this->authorize('create', User::class);
        }

        User::updateOrCreate(
            ['id' => $this->id],
            $this->validate()
        );

        flash(
            isset($this->employee->id)
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            isset($this->employee->id)
                ? __('employees.messages.successes.updated', ['name' => $this->last_name])
                : __('employees.messages.successes.stored', ['name' => $this->last_name]),
            'success'
        );


        return $this->redirect(route('employees.index'));
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
            'position' => [
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
        return view('livewire.employees.employee-form');
    }
}
