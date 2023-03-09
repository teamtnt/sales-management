<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create(config('sales-management.tablePrefix').'campaigns', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("description")->nullable();
            $table->unsignedBigInteger("pipeline_id");
            $table->unsignedBigInteger("contact_list_id")->nullable();
            $table->unsignedInteger("status")->default(0);
            $table->timestamps();
        });

        Schema::create(config('sales-management.tablePrefix').'campaign_assignee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("campaign_id");
            $table->unsignedBigInteger("assignee_id");

            $table->foreign('campaign_id')
                ->references('id')
                ->on(config('sales-management.tablePrefix').'campaigns')
                ->cascadeOnDelete();

            $table->foreign('assignee_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::drop(config('sales-management.tablePrefix').'campaign_assignee');
        Schema::drop(config('sales-management.tablePrefix').'campaigns');
    }
};
