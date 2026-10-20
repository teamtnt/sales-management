<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table(config('sales-management.tablePrefix').'leads', function (Blueprint $table) {
            $table->string('preferred_contact_method')->nullable();
            $table->string('preferred_contact_time')->nullable();
        });
    }

    public function down()
    {
        Schema::table(config('sales-management.tablePrefix').'leads', function (Blueprint $table) {
            $table->dropColumn(['preferred_contact_method', 'preferred_contact_time']);
        });
    }
};
