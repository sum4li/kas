<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_charges', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('transaction_id');
            $table->uuid('currency_id');
            $table->string('name')->nullable();            
            $table->string('slug')->nullable();                        
            $table->string('code')->nullable();            
            $table->string('rates')->nullable();                        
            $table->string('tax_status')->nullable();                        
            $table->string('selling_idr')->nullable()->default('0');
            $table->string('selling_usd')->nullable()->default('0');
            $table->string('buying_idr')->nullable()->default('0');
            $table->string('buying_usd')->nullable()->default('0');
            $table->string('debit_note_idr')->nullable()->default('0');
            $table->string('debit_note_usd')->nullable()->default('0');
            $table->string('credit_note_idr')->nullable()->default('0');
            $table->string('credit_note_usd')->nullable()->default('0');
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
        Schema::dropIfExists('transaction_charges');
    }
}
