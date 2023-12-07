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
        Schema::table(config('sales-management.tablePrefix') .'lead_activities', function (Blueprint $table) {
            //
            $table->boolean('is_done')->default(false);
        });
    }

};
