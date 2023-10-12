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
        Schema::create('restriction_access', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable()->references("id")->on("users")->cascadeOnDelete();
            $table->boolean('person')->default(0);
            $table->boolean('organisation')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restriction_access');
    }
};
