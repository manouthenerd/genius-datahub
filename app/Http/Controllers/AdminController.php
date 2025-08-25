<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminSessionRequest;

class AdminController extends Controller
{
    public function store(AdminSessionRequest $request) {

        $request->authenticate();
    }
}
