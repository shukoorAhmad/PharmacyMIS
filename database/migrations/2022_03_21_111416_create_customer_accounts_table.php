<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_accounts', function (Blueprint $table) {
            $table->id('customer_account_id');
            $table->integer('customer_id');
            $table->integer('bill_id')->default(0);
            $table->float('money')->default(0);
            $table->float('usd')->default(0);
            $table->float('afg')->default(0);
            $table->float('kal')->default(0);
            $table->float('usd_afg');
            $table->float('usd_kal');
            $table->tinyInteger('in_out');
            $table->string('comment')->nullable();
            $table->date('date');
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
        Schema::dropIfExists('customer_accounts');
    }
}
