<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function GetInfoAboutCompany()
    {
        $company = Company::get()->first()->where('id', session('company_id'));
        dd($company);
    }
}
