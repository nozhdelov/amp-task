<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Index extends Controller
{
    public function index(Request $request){
        return View::make('layout', [
            'contentTpl' => 'index/index'
        ]);
    }
}
