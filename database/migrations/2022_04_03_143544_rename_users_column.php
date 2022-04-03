<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameUsersColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company', function(Blueprint $table)
        {
            $table->renameColumn('indusry_id', 'industry_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company', function(Blueprint $table)
        {
            $table->renameColumn('industry_id', 'indusry_id');
        });
    }
}
