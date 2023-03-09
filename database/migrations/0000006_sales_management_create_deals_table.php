<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        /*  Schema::create(config('sales-management.tablePrefix').'deals', function (Blueprint $table) {
              $table->id();
              $table->string("name");
              $table->string("description")->nullable();
              $table->integer("worth")->default(0);
              $table->integer("status")->default(\Teamtnt\SalesManagement\Models\Status::DEAL_STATUS_NEW);
              $table->timestamps();
          });*/
    }

    public function down()
    {
        //Schema::drop(config('sales-management.tablePrefix').'deals');
    }
};
