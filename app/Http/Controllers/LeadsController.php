<?php

namespace App\Http\Controllers;

use App\Models\Leads;

class LeadsController extends Controller
{

    public function index()
    {
        $modal = new Leads();
        $item = $modal->getAllLeads();
        return view('leads', compact('item'));
    }

}
