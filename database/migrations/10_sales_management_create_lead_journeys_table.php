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
        Schema::create(config('sales-management.tablePrefix').'lead_journeys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("lead_id")->index();
            $table->unsignedBigInteger("task_id")->index();
            $table->unsignedBigInteger("workflow_id")->index();
            $table->string("current_place")->nullable();
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
        Schema::drop(config('sales-management.tablePrefix').'lead_journeys');
    }
};
