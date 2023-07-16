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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('contact_id');
            $table->unsignedBigInteger('owner_id');
            $table->bigInteger('deal_amount');
            $table->date('created_on')->nullable()->default(null);
            $table->date('closed_on');
            $table->string('status');
            $table->string('note');

            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');

        });

        Schema::create('deal_items', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('deal_id');
            $table->unsignedBigInteger('item_id');

            $table->foreign('deal_id')->references('id')->on('deals')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
        Schema::dropIfExists('deal_items');
    }
};
