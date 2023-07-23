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
        Schema::create('birthday_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('tm')->nullable();
            $table->text('ru')->nullable();
            $table->text('en')->nullable();
            $table->text('zh')->nullable();
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
        Schema::dropIfExists('birthday_messages');
    }
};
