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
        
        Schema::create('notification_users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 150)->unique();
        });
        
        Schema::create('notification_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('notification_user_id')->index();
            $table->float('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_users');
        Schema::dropIfExists('notification_settings');
    }
};
