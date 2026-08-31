<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * This file shipped empty, which is why `artisan migrate` failed with
 * "Class CreatePasswordResetsTable not found" — an empty file declares no
 * migration class, and the migrator resolves the class from the filename.
 *
 * The table name matches config/auth.php's password broker, which has always
 * pointed at `password_resets` rather than Laravel's newer
 * `password_reset_tokens`.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('password_resets')) {
            return;
        }

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('password_resets');
    }
};
