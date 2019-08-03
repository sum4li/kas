<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->uuid('id');
            $table->uuid('account_id')->nullable();
            $table->string('transaction_type')->nullable();
            $table->date('transaction_date')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();            
            $table->text('description')->nullable();
            $table->string('images')->nullable();            
            $table->string('amount')->nullable();            
            $table->softDeletes();
            $table->timestamps();
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
