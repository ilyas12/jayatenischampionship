<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Event registration module.
 *
 * Derived from the tennis registration form, but deliberately not a tennis
 * table. The form's fields fall into three groups:
 *
 *   who is registering   captain_name / captain_email / captain_phone
 *                        -> real columns, every event has these
 *   what they registered category_id, grade, team_*, city, founded, notes,
 *                        consents, members[]
 *                        -> `data` JSON, different for every event type
 *   payment state        amount, proof, status
 *                        -> real columns, the flow is the same for any event
 *
 * Table names are unprefixed here; the connection applies DB_PREFIX
 * (terre217_) like every other table in this database.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // What a registration costs. Nullable for free events.
            $table->decimal('price', 14, 2)->nullable();

            // Shown on the confirmation page and in the payment email: bank
            // account, transfer reference, deadline wording. Free text so a new
            // event does not need a code change.
            $table->text('payment_instructions')->nullable();

            $table->dateTime('opens_at')->nullable();
            $table->dateTime('closes_at')->nullable();
            $table->boolean('publish')->default(false);
            $table->timestamps();
        });

        Schema::create('event_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id')->index();

            // Public reference. The registrant quotes this on the transfer and
            // types it into the payment confirmation page, so it is the lookup
            // key for the whole flow and has to be unique.
            $table->string('code', 24)->unique();

            // The registrant. Named generically because a future event will not
            // have a "captain" — the tennis form's captain_* fields land here.
            $table->string('name');
            $table->string('email');
            $table->string('phone', 40)->nullable();

            // Everything event-specific: category_id, grade, team_name,
            // team_short, city, founded, notes, accept_rules, accept_media and
            // the members[] repeater.
            // ponytail: members live in this JSON rather than their own table.
            // Fine while they are only ever read back as a block; give them a
            // table if the admin needs to search or edit a single member.
            $table->json('data')->nullable();

            // Copied from events.price at registration time so a later price
            // change cannot alter what someone was asked to pay.
            $table->decimal('amount', 14, 2)->nullable();

            $table->enum('status', [
                'pending',              // registered, waiting for them to pay
                'awaiting_verification',// proof uploaded, waiting on an admin
                'paid',                 // admin confirmed the money arrived
                'rejected',             // admin rejected the proof
            ])->default('pending')->index();

            // Uploaded on the payment confirmation page.
            $table->string('payment_proof')->nullable();
            $table->dateTime('paid_at')->nullable();

            // Set when an admin moves the row out of awaiting_verification.
            $table->dateTime('verified_at')->nullable();
            $table->string('verified_by')->nullable();

            // Shown to nobody but the admin: why it was rejected.
            $table->text('admin_note')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
        Schema::dropIfExists('events');
    }
};
