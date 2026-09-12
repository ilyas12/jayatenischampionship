<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Sponsors and partners, per edition.
 *
 * The CMS's own `brand` module stores the same shape — logo, title, link,
 * order, publish — and was the obvious thing to reuse, but it does not hold
 * up: it already carries the furniture brands the template shipped with, its
 * `id` column has no AUTO_INCREMENT so inserts fail, and it is global where
 * sponsors belong to the edition they backed.
 *
 * Scoped on event_id like every other event_* table, so last year's sponsors
 * stay attached to last year.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('event_partners')) {
            return;
        }

        Schema::create('event_partners', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id')->index();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('url')->nullable();
            $table->integer('order_id')->default(0);
            $table->boolean('publish')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_partners');
    }
};
