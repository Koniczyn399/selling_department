<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class SpecialUserController extends Controller
{

    public function index()
    {
       
       
        $this->authorize('viewAny', User::class);
            
            return view(
                'employees.employees_index',
                [
                    'employees' => User::paginate(
                        config('pagination.default')
                    )
            
                ]
            );
    }

    public function create()
    {
        //$this->authorize('create', User::class);
        return view(
            'employees.employee_form'
        );
    }


    public function edit(User $employee)
    {
        //$this->authorize('update', $user);
        //dd($employee);
        
        return view(
            'employees.employee_form',
            [
                'employee'=> $employee,
            ]
        );

    }

    public function show(User $user)
    {
        //$this->authorize('update', $user);
        $orders=null;
        
            $orders= Order::query()
            ->join('users as clients', function ($users) {
                $users->on('orders.client_id', '=', 'clients.id');
            })->join('users as sellers', function ($users) {
                $users->on('orders.seller_id', '=', 'sellers.id');
            })
            ->select([
                'orders.id',            
                'clients.name as client_name',
                'clients.last_name as client_last_name',

                'sellers.name as seller_name',
                'sellers.last_name as seller_last_name',

                'orders.date_of_order',
                'clients.position as position' ,

            ])->where('orders.client_id', '=', $user->id)->paginate(config('pagination.default'));
   


        return view(
            'employees.employee_show',
            [
                'user'=> $user,
                'orders' => $orders,
            ]
        );
    }

}
