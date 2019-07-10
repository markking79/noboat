<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pack_season_id')->nullable();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->integer('heart_count')->nullable();
            $table->integer('visible_item_count')->nullable();
            $table->float('visible_ounces', 32, 2)->nullable();
            $table->float('visible_cost', 32, 2)->nullable();
            $table->boolean('is_visible')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packs');
    }
}
