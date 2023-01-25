<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(config('sales-management.tablePrefix').'pipelines', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("description")->nullable();
            $table->timestamps();
        });

        Schema::create(config('sales-management.tablePrefix').'pipeline_stages', function (Blueprint $table) {
            $table->id();
            $table->integer("pipeline_id");
            $table->string("name")->nullable();
            $table->string("description")->nullable();
            $table->string("color", 20)->nullable();
            $table->json('properties')->nullable();
        });
    }

    public function down()
    {
        Schema::drop(config('sales-management.tablePrefix').'pipelines');
        Schema::drop(config('sales-management.tablePrefix').'pipeline_stages');
    }
};
