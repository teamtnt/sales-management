<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create(config('sales-management.tablePrefix').'messages', function (Blueprint $table) {
            $table->id();
            $table->string("from_email");
            $table->string("from_name")->nullable();
            $table->string("subject");
            $table->text("body")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop(config('sales-management.tablePrefix').'messages');
    }
};
