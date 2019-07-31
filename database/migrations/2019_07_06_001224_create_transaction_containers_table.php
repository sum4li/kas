<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionContainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_containers', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('transaction_id');
            $table->string('container_number', 50)->nullable();
            $table->string('seal_number', 50)->nullable();
            $table->string('size', 50)->nullable();
            $table->string('qty', 50)->nullable();
            $table->uuid('unit_id');
            $table->string('weight', 50)->nullable();
            $table->string('measurement', 50)->nullable();
            $table->string('commodity')->nullable();
            $table->string('facility')->nullable();
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
        Schema::dropIfExists('transaction_containers');
    }
}
