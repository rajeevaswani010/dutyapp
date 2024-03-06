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
        Schema::table('users', function (Blueprint $table) {

            //add dob
            $table->date('dob')->nullable();

            //add doj
            $table->date('doj')->nullable();

            //add employee id
            $table->string('employee_id');

            //add gender
            $table->enum('gender', ['male', 'female', 'other'])->nullable();

            //add phone
            $table->string('phone')->nullable();

            //add is_active
            $table->boolean('is_active')->default(true);

            //add address
            $table->text('address')->nullable();

            //add designation
            $table->string('designation')->nullable();

            //add department
            $table->string('department')->nullable();

            //add supervisor id
            $table->integer('supervisor_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                        'dob', 
                        'doj', 
                        'employee_id',
                        'gender',
                        'phone',
                        'is_active',
                        'address',
                        'designation',
                        'department',
                        'supervisor_id'
                    ]);
        });
    }
};
