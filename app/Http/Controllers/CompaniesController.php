<?php

namespace App\Http\Controllers;

use App\Models\Companies;

class CompaniesController extends Controller
{
    public function index()
    {

        $modal = new Companies();
        $item = $modal->getAll();
        return view('companies', compact('item'));
    }
}
