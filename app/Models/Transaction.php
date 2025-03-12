<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_email',
        'reciever_email',
        'status',
        'amount',
        'motif',
        'sender_id',
        'receiver_Rib'
    ];
}
