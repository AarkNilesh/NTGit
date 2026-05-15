#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")/.."
php bin/setup-local.php "$@"
echo ""
echo "Starting Numerology SaaS at http://127.0.0.1:8000"
echo "Press Ctrl+C to stop."
php -S 127.0.0.1:8000 -t .
