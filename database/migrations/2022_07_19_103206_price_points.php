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
        Schema::create('price_points', function (Blueprint $table) {
            $table->id();
            $table->string('symbol', 10)->index();
            $table->float('last_price');
            $table->float('low');
            $table->float('high');
            $table->float('ask');
            $table->double('volume');
            $table->dateTime('created_at')->index()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_points');
    }
};
