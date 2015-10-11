<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');

            $table->string('name');
            $table->smallInteger('sort_order')->default('99');
            $table->string('filter_attr');

            $table->boolean('show_in_nav')->default(0);
            $table->boolean('is_show')->default(1);
            $table->string('thumb');

            $table->text('desc');

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
        //
    }
}
