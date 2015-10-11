<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->decimal('price', 10, 2);
            $table->integer('type_id');
            $table->text('img');
            $table->string('thumb');
            $table->tinyInteger('best');
            $table->tinyInteger('hot');
            $table->tinyInteger('new');
            $table->tinyInteger('onsale');
            $table->tinyInteger('promote');
            $table->smallInteger('number');
            $table->integer('brand_id');
            $table->integer('category_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
