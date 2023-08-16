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
        Schema::create('mdeposits', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('message')->nullable();
            $table->double('amount',20,2);
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('mdeposits');
    }
};
