<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDsoftComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsoft_comments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->default(0);
            $table->string('item_type')->nullable();
            $table->integer('item_id')->default(0);
            $table->mediumText('content')->nullable();
            $table->string('image')->nullable();

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
        Schema::dropIfExists('dsoft_comments');
    }
}
