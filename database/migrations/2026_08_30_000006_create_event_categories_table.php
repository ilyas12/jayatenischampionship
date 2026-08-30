<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The draws an event offers — Men's Singles, Club Teams and so on.
 *
 * `code` is the value the registration form posts as category_id, so the form's
 * select can be built from this table instead of the hardcoded ms/ws/md/wd/xd/ct
 * list, and a registration's stored category can be resolved back to a name.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id')->index();

            $table->string('code', 20);           // "ms" — posted as category_id
            $table->string('name');               // "Men's Singles"
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('draw_size')->nullable();

            // Free label beside the draw size: "Open", "4 places left".
            // Not derived from entry counts — a draw can be closed early or held
            // open past a full draw, and the organisers say which.
            $table->string('status_label', 40)->nullable();

            $table->integer('order_id')->default(0);
            $table->boolean('publish')->default(true);
            $table->timestamps();

            $table->unique(['event_id', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_categories');
    }
};
