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
        Schema::create('revisions', function (Blueprint $table) {
            $table->id();
            $table->morphs('owner');
            $table->morphs('revisionable');
            $table->string('column_name')->nullable()->comment('The column name revised');
            $table->text('old_value')->nullable()->comment('The old value of the column');
            $table->text('new_value')->nullable()->comment('The new value of the column');
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revisions');
    }
};
