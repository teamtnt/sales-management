<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create(config('sales-management.tablePrefix').'tasks', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("description")->nullable();
            $table->unsignedBigInteger("pipeline_id");
            $table->unsignedBigInteger("contact_list_id")->nullable();
            $table->integer("status")->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop(config('sales-management.tablePrefix').'tasks');
    }
};