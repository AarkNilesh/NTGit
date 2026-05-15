#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")"
exec ./bin/run-local.sh "$@"
