<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function create(Request $request){



        $sender_id = $request['id'];
        $receiver_email = $request['email'];

       $user = DB::table('users')->where('email', $receiver_email);


       dd($user);
    }
}
