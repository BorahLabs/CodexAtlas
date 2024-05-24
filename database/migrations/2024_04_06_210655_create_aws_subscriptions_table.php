<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('aws_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('aws_customer_id')->unique();
            $table->dateTime('expires_at')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('aws_subscriptions');
    }
};
