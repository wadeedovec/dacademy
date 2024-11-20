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
        Schema::table('responses', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('exam_id')->nullable()->after('id');  // Add the exam_id column
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');  // Foreign key constraint to exams table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('responses', function (Blueprint $table) {
            //
            $table->dropForeign(['exam_id']);
            $table->dropColumn('exam_id');
        });
    }
};
