<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Order of play for an event.
 *
 * `detail` and `note` are display copy rather than structured fields: the
 * mockup renders lines like "All courts · 08:00 – 18:00" and "Ticketed", which
 * are ranges and free labels. Modelling courts and time ranges would buy
 * nothing until something needs to query them.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id')->index();

            // `date` is a keyword; starts_on also says what it means.
            $table->date('starts_on')->nullable();

            $table->string('title');
            $table->string('detail')->nullable();   // "Centre & Court 1 · 10:00"
            $table->string('note', 80)->nullable(); // "Ticketed", "Sold out"

            $table->integer('order_id')->default(0);
            $table->boolean('publish')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_schedule');
    }
};
