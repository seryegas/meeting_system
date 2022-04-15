<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Industry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function GetInfoAboutCompany()
    {
        $company = Company::where('id', session('company_id'))->first();
        $supervisor = User::where('id', $company->supervisor_id)->first();
        $secretary = User::where('id', $company->secretary_id)->first();
        $industry_type = Industry::where('industry_id', $company->industry_id)->first();
        return view('profile.work_with_company', compact('company', 'supervisor', 'secretary', 'industry_type'));
    }

    public function GetSecretary()
    {
        $company = Company::where('id', session('company_id'))->first();
        $secretary = User::where('id', $company->secretary_id)->first();
        $users = User::where('company_id', session('company_id'))->get();
        return view('profile.make_secretary', compact('secretary', 'users')); 
    }

    public function StoreNewSecretary(Request $request)
    {
        if (is_null($request->get('user_id')))
        {
            return redirect(route('make_secretary'))->withErrors([
                'any' => 'Не выбран сотрудник'
            ]);
        }
        $password = User::where('id', session('user_id'))->first()->password;
        $pass = $request->get('password');
        if (!Hash::check($pass, $password))
        {
            return redirect(route('make_secretary'))->withErrors([
                'any' => 'Пароли не совпадают'
            ]);
        }
        $user = User::find($request->get('user_id'));
        $previous_secretary = User::where('user_role', 2)->first();
        if (isset($previous_secretary))
        {
            $previous_secretary->update(['user_role' => 1]);
        }
        Company::where('id', session('company_id'))->update(['secretary_id' => $user->id]);
        $user->update(['user_role' => 2]);
        return redirect(route('make_secretary'))->with('success', 'Назначен новый секретарь!');
    }
}
