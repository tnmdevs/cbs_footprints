<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCBSFootprintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cbs_footprints', function (Blueprint $table) {
            $table->id();
            $table->string('msisdn')->index()->nullable();
            $table->string('service');
            $table->string('trans_id')->index();
            $table->json('request');
            $table->text('request_body')->nullable();
            $table->string('status')->nullable();
            $table->string('message')->nullable();
            $table->text('response')->nullable();
            $table->boolean('success')->nullable();
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
        Schema::dropIfExists('password_resets');
    }
}
