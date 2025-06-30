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
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['user_id']);

            // Só altera a coluna existente para nullable
            $table->unsignedBigInteger('user_id')->nullable()->change();

            // Adiciona novamente a FK
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
             $table->dropForeign(['user_id']);

            // Volta a ser NOT NULL
            $table->unsignedBigInteger('user_id')->nullable(false)->change();

            // Recria a FK
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');
        });
    }
};
