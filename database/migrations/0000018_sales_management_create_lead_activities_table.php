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
        Schema::create(config('sales-management.tablePrefix') . 'lead_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("lead_id")->index();
            $table->unsignedBigInteger('created_by')->nullable();

            $table->string('type')->nullable();

            //start date, start time, end date end time
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            //description
            $table->text("description")->nullable();

            $table->timestamps();

            $table->foreign('lead_id')
                ->references('id')
                ->on(config('sales-management.tablePrefix') . 'leads')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(config('sales-management.tablePrefix') . 'lead_notes');
    }
};
