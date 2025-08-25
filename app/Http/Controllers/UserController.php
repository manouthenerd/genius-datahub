<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\User;

class UserController extends Controller
{
    public function store(UserFormRequest $request) {
        
        $user = User::create([
           
        ]);
        
    }
}
