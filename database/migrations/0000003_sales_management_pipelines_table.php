<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create(config('sales-management.tablePrefix').'pipelines', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->text("description")->nullable();
            $table->timestamps();
        });

        Schema::create(config('sales-management.tablePrefix').'pipeline_stages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("pipeline_id");
            $table->string("name")->nullable();
            $table->text("description")->nullable();
            $table->string("color", 20)->nullable();
            $table->json('properties')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop(config('sales-management.tablePrefix').'pipelines');
        Schema::drop(config('sales-management.tablePrefix').'pipeline_stages');
    }
};
