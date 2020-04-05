<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateArtworksSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('artworks_sales');
        Schema::create('artworks_sales', function (Blueprint $table) {
            $table->bigInteger('sales_id');
            $table->unsignedInteger('artworks_id');
            $table->integer('qty');
            $table->timestamps();
            $table->primary(['sales_id', 'artworks_id']);
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
