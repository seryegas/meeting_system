<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $industryList = Industry::all();
        return view('registration', compact('industryList'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        
    }
}
