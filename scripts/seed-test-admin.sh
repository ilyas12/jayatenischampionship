#!/usr/bin/env bash
#
# Create the throwaway admin account that the authenticated half of
# scripts/smoke-test.sh logs in with. Local Docker database only — the
# credentials are deliberately well-known and must never exist anywhere else.
#
#   ./scripts/seed-test-admin.sh
#
set -euo pipefail

EMAIL="smoke@test.local"
PASSWORD="smoketest123"
TABLE="terre217_administrator"

HASH="$(docker compose exec -T app php -r \
    "echo password_hash('${PASSWORD}', PASSWORD_BCRYPT);")"

docker compose exec -T db mysql -ucms -psecret cms_template_engine <<SQL 2>/dev/null
DELETE FROM ${TABLE} WHERE email = '${EMAIL}';
INSERT INTO ${TABLE}
    (id, email, password, name, last_login, active, created_at, updated_at, remember_token)
VALUES
    (9999, '${EMAIL}', '${HASH}', 'Smoke Test', NOW(), 1, NOW(), NOW(), '');
SQL

echo "Seeded ${EMAIL} / ${PASSWORD}"
