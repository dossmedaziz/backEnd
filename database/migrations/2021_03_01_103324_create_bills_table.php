<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('CASCADE');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id')
                    ->references('id')
                    ->on('roles')
                    ->onDelete('SET NULL');
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
        Schema::dropIfExists('bills');
    }
}