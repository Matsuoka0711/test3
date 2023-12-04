<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class Company extends Model{

    // productsテーブルとの関連付け
    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function getCompanies() {
        $companies = DB::table('companies')->get();
        
        return $companies;
    }

    protected $fillable = [
        'company_id',
    ];
}
