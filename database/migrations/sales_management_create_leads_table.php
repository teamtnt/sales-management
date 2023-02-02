<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {


        Schema::create(config('sales-management.tablePrefix').'leads', function (Blueprint $table) {
            $table->id();
            $table->integer("task_id")->index();
            $table->integer("contact_id")->index();
            $table->integer("pipeline_id")->index();
            $table->integer("pipeline_stage_id")->index();
        });
    }

    public function down()
    {
        Schema::drop(config('sales-management.tablePrefix').'leads');
    }
};
