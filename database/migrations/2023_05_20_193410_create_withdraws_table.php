<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->double('amount' ,20 ,2);
            $table->string('code');
            $table->string('message')->nullable();
            $table->double('charge' ,10 ,2)->default(0);
            $table->double('final' ,20 ,2);
            $table->double('old_balance' ,20 ,2);
            $table->double('new_balance' ,20 ,2);
            $table->smallInteger('status')->default(2);
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
        Schema::dropIfExists('withdraws');
    }
};
