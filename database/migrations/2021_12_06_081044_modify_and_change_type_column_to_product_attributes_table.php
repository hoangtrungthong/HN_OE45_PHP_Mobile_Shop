<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAndChangeTypeColumnToProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->integer('color')->change();
            $table->integer('ram')->change();
            $table->string('price')->change();
            $table->renameColumn('color', 'color_id');
            $table->renameColumn('ram', 'memory_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->json('color')->change();
            $table->json('ram')->change();
            $table->json('price')->change();
            $table->renameColumn('color_id', 'color');
            $table->renameColumn('memory_id', 'ram');
        });
    }
}
