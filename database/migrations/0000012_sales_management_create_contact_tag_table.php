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
        Schema::create(config('sales-management.tablePrefix').'contact_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_id')->index();
            $table->unsignedBigInteger('tag_id')->index();

            $table->foreign('contact_id')->references('id')->on(config('sales-management.tablePrefix').'contacts')->cascadeOnDelete();;
            $table->foreign('tag_id')->references('id')->on(config('sales-management.tablePrefix').'tags');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(config('sales-management.tablePrefix').'contact_tag');
    }
};
