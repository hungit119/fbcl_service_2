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

        Schema::create('friends', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('friend_id');
            $table->unsignedBigInteger('user_id');
            $table->primary(['user_id', 'friend_id']);
            $table->foreign('friend_id')->references('id')->on('users');
            $table->tinyInteger('status')->default(0)->comment('0');
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
        Schema::dropIfExists('friends');
    }
};
