<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('tkt_booking_details', function (Blueprint $table) {
            $table->tinyInteger('INSURANCE', 1)->default(0);
            $table->string('BARCODE', 160);
            $table->tinyInteger('IS_BARCODE_SCANNED', 1)->default(0);
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
