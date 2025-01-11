<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {

 
 
        $this->authorize('viewAny', User::class);


        return view(
            'users.index',
            [
                'users' => User::paginate(
                    config('pagination.default')
                )
            ]
        );
    }


    public function create()
    {
        //$this->authorize('create', User::class);

        return view(
            'users.form',[
                'show'=> false,
            ]
        );
    }


    public function edit(User $user)
    {
        //$this->authorize('update', $user);

        return view(
            'users.form',
            [
                'user'=> $user,
            ]
        );
    }

    public function show(User $user)
    {
        //$this->authorize('update', $user);

        return view(
            'users.show',
            [
                'user'=> $user,
            ]
        );
    }




  
}
