<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('backorders', function (Blueprint $table) {
            $table->unsignedBigInteger('order_reference')->change();
            $table->renameColumn('order_reference', 'order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('backorders', function (Blueprint $table) {
            $table->string('order_id')->change();
            $table->renameColumn('order_id', 'order_reference');
        });
    }
};
