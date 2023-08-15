<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('contact_name');
            $table->string('contact_email')->unique();
            $table->unsignedBigInteger('contact_phone_number');
            $table->string('contact_address');
            $table->text('contact_description');
            $table->string('company_name');
            $table->string('job_title');
            $table->string('status');
            $table->unsignedBigInteger('created_by');
            $table->text('contact_image');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');  //foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
