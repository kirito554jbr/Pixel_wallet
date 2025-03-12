<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function delete(Request $request)
    {
        $id = $request['id'];
        User::find($id)->delete();
    }
}
