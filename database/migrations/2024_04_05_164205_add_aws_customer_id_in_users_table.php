<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('aws_customer_id')->nullable()->unique();
            $table->string('aws_account_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_aws_customer_id_unique');
            $table->dropColumn('aws_customer_id');
            $table->dropColumn('aws_account_id');
        });
    }
};
