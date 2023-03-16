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
        Schema::create(config('sales-management.tablePrefix').'postmark_events', function (Blueprint $table) {
            $table->id();
            $table->string('event_type');
            $table->integer('message_id')->nullable();
            $table->string('postmark_message_id')->nullable();
            $table->string('recipient')->nullable();
            $table->json('payload')->nullable();
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
        Schema::drop(config('sales-management.tablePrefix').'postmark_events');
    }
};
