<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function test(Request $request){
        return response()->json($request['test']);
    }
}
