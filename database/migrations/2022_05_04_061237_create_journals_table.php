<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('source');
            $table->integer('source_id')->default(0);
            $table->integer('bill_id')->default(0);
            $table->float('money')->default(0);
            $table->float('usd')->default(0);
            $table->float('afg')->default(0);
            $table->float('kal')->default(0);
            $table->float('usd_afg');
            $table->float('usd_kal');
            $table->tinyInteger('in_out');
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('journals');
    }
}
