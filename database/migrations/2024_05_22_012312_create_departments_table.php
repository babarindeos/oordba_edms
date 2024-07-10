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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('college_id');            
            $table->string('department_name')->unique();
            $table->string('department_code')->unique();
            $table->timestamps();
            $table->foreign('college_id')->references('id')->on('colleges')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departments', function(Blueprint $table){
            $table->dropForeign(['college_id']);
        });

        Schema::dropIfExists('departments');
    }
};
