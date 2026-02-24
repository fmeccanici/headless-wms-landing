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
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants');
        });

        Schema::table('picklists', function (Blueprint $table) {
            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants');
        });

        Schema::table('backorders', function (Blueprint $table) {
            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
