<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('sales-management.tablePrefix') .'contacts', function (Blueprint $table) {
            //
            $table->fulltext('firstname', 'contact_fulltext_first_name');
            $table->fulltext('lastname', 'contact_fulltext_last_name');
            $table->fulltext('email', 'contact_fulltext_email');
            $table->fulltext('company_name', 'contact_fulltext_company_name');
        });
    }

};
