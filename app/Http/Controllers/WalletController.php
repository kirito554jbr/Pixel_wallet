<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{


    public function index(){
        $wallet = Wallet::all();

    }

    public function create(){

        // dd($user->id);

        do {
            // get a random 12 digit number
            $Rib = str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
            // check if it is unique
            $exists = Wallet::where('Rib', $Rib)->exists();
        } while ($exists);

        // dd($Rib);
        
        // return $identifier

        Wallet::create([
            'Balance' => 0,
            'Rib' => $Rib,
            'user_id' => 2,
        ]);
    }

    public function update(Request $request){


        $wallet = Wallet::find($request['id']);

        $wallet->Balance += $request["amount"];

        $wallet->update();
    }
}
