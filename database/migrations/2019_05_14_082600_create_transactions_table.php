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
            $table->uuid('shipper_id');
            $table->uuid('consignee_id');
            $table->uuid('notify_id');
            $table->uuid('agent_id');
            $table->uuid('invoice_id')->nullable();

            $table->string('job_number', 20)->nullable();
            $table->string('billing_number', 20)->nullable();
            $table->string('transaction_type', 100)->nullable();

            $table->date('etd')->nullable();
            $table->date('eta')->nullable();
            $table->string('origin', 10)->nullable();

            $table->string('mbl', 100)->nullable();
            $table->string('hbl', 100)->nullable();
            $table->string('cargo_type', 100)->nullable();
            $table->string('bc11', 50)->nullable();
            $table->string('bc23', 50)->nullable();
            $table->string('pos', 10)->nullable();
            $table->string('sub_pos', 10)->nullable();
            $table->string('location', 10)->nullable();
            $table->date('delivery')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('pol')->nullable();
            $table->string('pod')->nullable();
            $table->string('vessel')->nullable();
            $table->string('voyage')->nullable();

            $table->string('spj_number')->nullable();
            $table->string('trucking')->nullable();
            $table->string('driver')->nullable();
            $table->string('car_number')->nullable();
            $table->string('manager')->nullable();
            $table->string('staff_operasional')->nullable();
            $table->string('salesman')->nullable();
            $table->string('status')->nullable()->default('unpaid');
            
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
