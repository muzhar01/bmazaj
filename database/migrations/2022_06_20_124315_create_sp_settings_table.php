<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpSettingsTable extends Migration
{
    /**
     * Run the migrations.
     * ['name', 'link', 'email', 'password', 'remember_me', 'token', 'status'];
     * @return void
     */
    public function up()
    {
        Schema::create('sp_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('link')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('token')->nullable();
            $table->integer('status')->default(1);
            $table->integer('remember_me')->default(1);
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
        Schema::dropIfExists('sp_settings');
    }
}
