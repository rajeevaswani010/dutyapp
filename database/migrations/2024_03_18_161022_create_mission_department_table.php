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
        Schema::create('mission_department', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedInteger('mission_id')->unsigned();
            $table->unsignedInteger('department_id')->unsigned();

            $table->foreign('mission_id')->references('id')->on('mission')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('department')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_department');
    }
};
