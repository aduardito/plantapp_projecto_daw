<?php

/**
 * this table will store the transaction type
 * owner will put their plants to be given away, the other users will like, request the plant
 * likes is that they like the plant
 * wants is that they request the plant
 * confirms the owner of the plant has given away the plant to the user
 */

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
        Schema::create('transaction_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->boolean('active')->default(true);
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_type');
    }
};
