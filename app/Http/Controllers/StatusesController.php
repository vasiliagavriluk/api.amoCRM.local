<?php

namespace App\Http\Controllers;

use App\Models\Statuses;

class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Statuses::all();
        return view('statuses', compact('item'));
    }

}
