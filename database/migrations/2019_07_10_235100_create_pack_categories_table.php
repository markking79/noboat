<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pack_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string ('name');
            $table->text ('description')->nullable();
            $table->integer ('weight');
            $table->boolean ('is_visible');
            $table->boolean ('include_in_base_weight');
            $table->boolean ('include_in_pack_weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pack_categories');
    }
}
