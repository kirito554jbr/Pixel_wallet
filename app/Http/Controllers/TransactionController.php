<?php

namespace App\Http\Controllers;

use auth;use Exception;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function create(Request $request)
    {
        try {

            $sender = User::find($request['id']);
            // dd($sender);
            
            $sender_wallet = DB::table('wallets')->where('user_id', $request['id'])->first();
            
            if($sender_wallet->Balance > $request['amount']){
                
                $senderNewBalance = $sender_wallet->Balance - $request['amount'];
                // dd($sender_wallet);

            DB::table('wallets')
                ->where('user_id', $request['id'])
                ->update(['Balance' => $senderNewBalance]);



            $receiver_wallet = DB::table('wallets')->where('Rib', $request['receiver_Rib'])->first();

            $receiverNewBalance = $receiver_wallet->Balance + $request['amount'];



            DB::table('wallets')
                ->where('Rib', $request['receiver_Rib'])
                ->update(['Balance' => $receiverNewBalance]);



            $receiver = User::find($receiver_wallet->user_id);
            //    dd($receiver);


            Transaction::create([
                'sender_email' => $sender->email,
                'reciever_email' => $receiver->email,
                'status' => "Pending",
                'amount' => $request['amount'],
                'motif' => $request['motif'],
                'sender_id' => $sender_wallet->id,
                'receiver_Rib' => $request['receiver_Rib'],

            ]);
            DB::commit();

            return "your balance is " . $sender_wallet->Balance;
        }else{
            return response([
                'message' => ['your Balance is not enough']
            ], 404);
        }
            
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function delete()
    {
        // $id = $request['id'];
        Wallet::find(
            5
        )->delete();
    }

    public function update(Request $request){
        $transaction = Transaction::find($request['id']);
        $transaction->update($request->all());
    }
}
