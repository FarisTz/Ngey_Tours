<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Duplicate migration has been disabled because tours table is created by an earlier migration.
    }

    public function down(): void
    {
        // No-op
    }
};
