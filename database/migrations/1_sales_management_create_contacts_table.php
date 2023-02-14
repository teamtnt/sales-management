<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create(config('sales-management.tablePrefix').'contacts', function (Blueprint $table) {
            $table->id();
            $table->string("salutation")->nullable();
            $table->string("firstname")->nullable();
            $table->string("lastname")->nullable();
            $table->string("job_title")->nullable();
            $table->string("email")->index()->nullable();
            $table->string("phone")->nullable();
            $table->string("company_name")->nullable();
            $table->string("vat")->nullable();
            $table->string("url")->nullable();
            $table->string("company_email")->index()->nullable();
            $table->string("address")->nullable();
            $table->string("postal", 20)->nullable();
            $table->string("city")->nullable();
            $table->string("country")->nullable();
            $table->integer("batch_id")->nullable();
            $table->timestamps();
        });

        Schema::create(config('sales-management.tablePrefix').'batches', function (Blueprint $table) {
            $table->id();
            $table->integer("uploader_id")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop(config('sales-management.tablePrefix').'contacts');
    }
};
