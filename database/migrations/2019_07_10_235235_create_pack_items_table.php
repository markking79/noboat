<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pack_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pack_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('purchase_link')->nullable();
            $table->string('image')->nullable();
            $table->float('ounces_each', 8, 2);
            $table->float('cost_each', 8, 2);
            $table->integer('quantity');
            $table->integer('weight');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('pack_id')->references('id')->on('packs')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('pack_categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pack_items');
    }
}
