<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorIdColumnAndMemoryIdColumnAndImageColumnToOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->integer('color_id')->after('product_id');
            $table->integer('memory_id')->after('color_id');
            $table->string('image')->after('memory_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn('color_id');
            $table->dropColumn('memory_id');
            $table->dropColumn('image');
        });
    }
}
