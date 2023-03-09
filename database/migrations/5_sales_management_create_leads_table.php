<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create(config('sales-management.tablePrefix').'leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("campaign_id")->index();
            $table->unsignedBigInteger("contact_id")->index();
            $table->unsignedBigInteger("pipeline_id")->index();
            $table->unsignedBigInteger("pipeline_stage_id")->index();

            $table->foreign('contact_id')
                ->references('id')
                ->on(config('sales-management.tablePrefix').'contacts')
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::drop(config('sales-management.tablePrefix').'leads');
    }
};
