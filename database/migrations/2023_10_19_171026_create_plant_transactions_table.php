<?php
/**
 * this table will store the transaction plant
 * owner will put their plants to be given away, the other users will like, request the plant
 * like is that they like the plant
 * wants is that they request the plant
 * confirm the owner of the plant has given away the plant to the user
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
        Schema::create('plant_transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // plant id contains the owner of the plant
            $table->foreignId('plant_id')->constrained(
                table: 'plants', 
                indexName: 'plant_id'
            )->onDelete('cascade');
            // user id, is the user who likes/wants the plant
            $table->foreignId('user_id')->constrained(
                table: 'users', 
                indexName: 'user_id'
            )->onDelete('cascade');
            $table->integer('transaction_type_id')->constrained(
                table: 'transaction_types', 
                indexName: 'transaction_type_id'
            )->onDelete('cascade');
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant_transaction');
        $table->dropForeign('plant_id');
        $table->dropIndex('plant_id');
        $table->dropColumn('plant_id');

        $table->dropForeign('user_id');
        $table->dropIndex('user_id');
        $table->dropColumn('user_id');

        $table->dropForeign('transaction_type_id');
        $table->dropIndex('transaction_type_id');
        $table->dropColumn('transaction_type_id');
    }
};
