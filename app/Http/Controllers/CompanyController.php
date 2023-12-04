<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function regist()
    {
        $companies = Company::all();
        return view('page.regist', compact('companies'));
    }

    public function show()
    {
        $companies = Company::all();
        return view('page.update', compact('companies'));
    }

    public function search(ProductRequest $request)
    {
        dd($request->search);
    }
}
