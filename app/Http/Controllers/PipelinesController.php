<?php

namespace App\Http\Controllers;

use App\Models\Pipeline;

class PipelinesController extends Controller
{
    public function index()
    {
        $item = Pipeline::all();
        return view('pipeline', compact('item'));
    }
}
