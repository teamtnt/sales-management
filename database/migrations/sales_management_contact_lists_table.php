<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(config('sales-management.tablePrefix').'contact_lists', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("description")->nullable();
            $table->timestamps();
        });

        Schema::create(config('sales-management.tablePrefix').'contact_list_contacts', function (Blueprint $table) {
            $table->id();
            $table->integer("contact_list_id")->index();
            $table->integer("contact_id")->index();
        });
    }

    public function down()
    {
        Schema::drop(config('sales-management.tablePrefix').'contact_lists');
        Schema::drop(config('sales-management.tablePrefix').'contact_list_contacts');
    }
};
