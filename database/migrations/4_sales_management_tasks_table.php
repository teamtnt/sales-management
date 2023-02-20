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
            $table->unsignedInteger("status")->default(\Teamtnt\SalesManagement\Models\Status::TASK_STATUS_NEW);
            $table->timestamps();
        });

        Schema::create(config('sales-management.tablePrefix').'task_assignee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("task_id");
            $table->unsignedBigInteger("assignee_id");

            $table->foreign('task_id')
                ->references('id')
                ->on(config('sales-management.tablePrefix').'tasks')
                ->cascadeOnDelete();

            $table->foreign('assignee_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::drop(config('sales-management.tablePrefix').'task_assignee');
        Schema::drop(config('sales-management.tablePrefix').'tasks');
    }
};
