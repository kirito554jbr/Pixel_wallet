<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('sender_email');
            $table->string('reciever_email');
            $table->string('status');
            $table->date('date');
            $table->integer('amount');
            $table->string('motif');
            $table->foreignId('sender_id')->constrained('wallets')->onDelete('cascade')->default(1);
            $table->foreignId('receiver_id')->constrained('wallets')->onDelete('cascade')->default(5);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
