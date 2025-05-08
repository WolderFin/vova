<?php

namespace App\Http\Controllers;

use App\Models\Sity;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        return view('index');
    }
    public function admin(){
        $cities = Sity::all();

        return view('admin', compact('cities'));
    }
    public function account(){
        return view('account');
    }
}
