<?php

// create a file for the new table
// php artisan make:migration create_plant_table

// run the migrations and create the table
// php artisan migrate

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
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('description');
            $table->string('image_url');
            $table->boolean('active')->default(true);
            $table->foreignId('user_id')->constrained(
                table: 'users', 
                indexName: 'plant_user_id'
            )->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant');
        $table->dropForeign('user_id');
        $table->dropIndex('plant_user_id');
        $table->dropColumn('user_id');
    }
};
