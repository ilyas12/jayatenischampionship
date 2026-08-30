<?php

use PHPUnit\Framework\TestCase;
use terre\Http\Models\EventRegistrationModel;

/**
 * Covers the two bits of the registration module with real logic in them: the
 * status vocabulary, and the summary the admin reads before approving a
 * payment. Both are pure — no database, so this runs anywhere.
 *
 *   vendor/bin/phpunit tests/EventRegistrationTest.php
 */
class EventRegistrationTest extends TestCase
{
    /** The labels and the migration's enum must not drift apart. */
    public function testStatusOptionsMatchTheEnum()
    {
        $migration = file_get_contents(
            __DIR__ . '/../database/migrations/2026_08_30_000001_create_event_registration_tables.php'
        );

        foreach (array_keys(EventRegistrationModel::statusOptions()) as $status) {
            $this->assertStringContainsString(
                "'" . $status . "'",
                $migration,
                "Status '{$status}' has a label but is not in the migration's enum."
            );
        }

        $this->assertSame(
            ['pending', 'awaiting_verification', 'paid', 'rejected'],
            array_keys(EventRegistrationModel::statusOptions())
        );
    }

    /** Every submitted field has to reach the admin, including the repeater. */
    public function testSummaryRendersGenericColumnsAndNestedData()
    {
        $registration = new EventRegistrationModel([
            'code'  => 'EV01-ABC123',
            'name'  => 'Rangga Wijaya',
            'email' => 'rangga@example.com',
            'phone' => '0811000111',
            'data'  => [
                'team_name' => 'Bandar Baru Lawn',
                'members'   => [
                    ['name' => 'Rangga Wijaya', 'role' => 'captain'],
                    ['name' => 'Sari Dewi', 'role' => 'player', 'rank' => ''],
                ],
            ],
        ]);

        $html = $registration->summary_html;

        $this->assertStringContainsString('EV01-ABC123', $html);
        $this->assertStringContainsString('rangga@example.com', $html);

        // JSON keys become readable labels.
        $this->assertStringContainsString('Team Name', $html);
        $this->assertStringContainsString('Bandar Baru Lawn', $html);

        // The repeater is listed rather than dumped as "Array".
        $this->assertStringNotContainsString('Array', $html);
        $this->assertStringContainsString('Sari Dewi', $html);

        // Empty sub-values are dropped, so no dangling "rank: ".
        $this->assertStringNotContainsString('rank:', $html);
    }

    public function testProofHtmlDistinguishesUploadedFromMissing()
    {
        $none = new EventRegistrationModel(['payment_proof' => null]);
        $this->assertStringContainsString('No proof uploaded', $none->proof_html);
    }
}
