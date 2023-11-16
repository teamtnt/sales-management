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
        Schema::create(config('sales-management.tablePrefix') . 'lead_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("lead_id")->index();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->text("note")->nullable();
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
