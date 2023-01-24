<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(config('sales-management.tablePrefix').'companies', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("vat")->nullable();
            $table->string("url")->nullable();
            $table->string("email")->index()->nullable();
            $table->string("address")->nullable();
            $table->string("postal", 20)->nullable();
            $table->string("city", 20)->nullable();
            $table->string("country", 3)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop(config('sales-management.tablePrefix').'companies');
    }
};
