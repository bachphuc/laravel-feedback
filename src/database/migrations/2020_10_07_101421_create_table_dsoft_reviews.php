<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDsoftReviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsoft_reviews', function (Blueprint $table) {
            $table->increments('id');

            $table->string('item_type')->nullable();
            $table->integer('item_id')->default(0);
            $table->integer('total_rating')->default(0);
            $table->decimal('average_rating', 5, 2)->default(0);

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
        Schema::dropIfExists('dsoft_reviews');
    }
}
