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
        Schema::disableForeignKeyConstraints();

        Schema::create('remarkable_news', function (Blueprint $table) {
            $table->foreign('new_id')->references('id')->on('news');
            $table->unsignedBigInteger('new_id');
            $table->unsignedBigInteger('remarkable_id');
            $table->primary(['new_id', 'remarkable_id']);
            $table->foreign('remarkable_id')->references('id')->on('remarkables');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at')->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remarkable_news');
    }
};
