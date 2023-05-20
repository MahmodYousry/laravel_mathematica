<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classrooms', function (Blueprint $table) {
            $table->foreignId('grade_id')->constrained()->onDelete('cascade');
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->foreignId('grade_id')->constrained()->onDelete('cascade');
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->foreignId('class_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_keys');
    }
}
