<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navbar_items', function (Blueprint $table) {
            $table->id();
            $table->string('name_dutch');
            $table->string('name_german');
            $table->string('name_english');
            $table->integer('index');
            $table->boolean('is_dropdown');
            $table->timestamps();
        });

       Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name_dutch');
            $table->string('name_german');
            $table->string('name_english');
            $table->string('name_view');
            $table->unsignedBigInteger('navbar_item_id');
            $table->foreign('navbar_item_id')->references('id')->on('navbar_items');
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
        //Schema::dropIfExists('pages');
        Schema::dropIfExists('navbar_items');
    }
}
