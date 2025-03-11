<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignkeyToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
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
        
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('receiver_id');
            $table->dropColumn('sender_id');

        }); 
    }
}
