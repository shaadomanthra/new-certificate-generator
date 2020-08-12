<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_details', function (Blueprint $table) {
            $table->id();
            $table->string('client');
            $table->string('activity')->nullable();
            $table->longText('verification_id');
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('email');
            $table->string('mobile_number')->nullable();
            $table->string('college')->nullable();
            $table->string('track')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('issued_date')->nullable();
            $table->string('percentage')->nullable();
            $table->string('template')->nullable();
            $table->string('issued_by')->nullable();
            $table->string('field_4')->nullable();
            $table->string('field_5')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificate_details');
    }
}
