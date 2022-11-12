<?php

namespace App\Http\Controllers;


use App\Models\Users;

class UsersController extends Controller
{
    public function index()
    {
        $item = Users::all();
        return view('users', compact('item'));
    }

}
