<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('tkt_booking', function (Blueprint $table) {
            $table->string('EMAIL', 160);
            $table->integer('PHONE_NUMBER', 15);
            $table->string('FLW_REF', 160);
            $table->string('TX_REF', 160);
            $table->string('TRANSACTION_ID', 100);
            $table->decimal('INSURANCE', $precision = 9, $scale = 2)->nullable()->default(0.00);
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
