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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('email');
            $table->string('fullname');
            $table->string('address')->nullable();
            $table->string('education_info')->nullable();
            $table->string('work_info')->nullable();
            $table->unsignedTinyInteger('gender')->nullable()->default(0)->comment('0');
            $table->tinyInteger('relationship')->nullable()->default(0)->comment('0');
            $table->dateTime('dob');
            $table->string('password');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
