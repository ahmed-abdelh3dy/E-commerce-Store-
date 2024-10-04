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
        Schema::create('profiles', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->date('birthday')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('street_address')->nullable();
            $table->char('country',2)->nullable();
            $table->char('locale',2)->default('en');
            $table->enum('gender', ['male' , 'female']);
            $table->timestamps();
            $table->softDeletes();
            $table->primary('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};