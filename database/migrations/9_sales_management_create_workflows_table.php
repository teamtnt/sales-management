<?php

use App\Models\Permission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('sales-management.tablePrefix').'workflows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("task_id")->index();
            $table->string("name");
            $table->text("description")->nullable();
            $table->jsonb("elements")->nullable();
            $table->text("state_machine_definition")->nullable();
            $table->unsignedInteger("status")->default(\Teamtnt\SalesManagement\Models\Status::WORKFLOW_STATUS_NEW);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(config('sales-management.tablePrefix').'workflows');
    }
};
