#!/usr/bin/env bash
set -euo pipefail

APP_ROOT="$(cd "$(dirname "$0")/.." && pwd)"
DIST_DIR="$APP_ROOT/dist"
PACKAGE_NAME="numerology-saas-local"
PACKAGE_DIR="$DIST_DIR/$PACKAGE_NAME"
ZIP_FILE="$DIST_DIR/$PACKAGE_NAME.zip"

rm -rf "$PACKAGE_DIR" "$ZIP_FILE"
mkdir -p "$PACKAGE_DIR"

rsync -a \
  --exclude 'dist/' \
  --exclude 'storage/' \
  --exclude 'vendor/' \
  --exclude 'react/node_modules/' \
  --exclude 'react/dist/' \
  "$APP_ROOT/" "$PACKAGE_DIR/"

cat > "$PACKAGE_DIR/START-HERE.txt" <<'TXT'
Numerology SaaS Local Package
=============================

Windows:
  1. Double-click Start-NumerologySaaS.bat to run directly from this folder.
  2. Or double-click bin\install-windows.bat to install a local copy and create a desktop shortcut.
  3. Open http://127.0.0.1:8000 in your browser.

macOS / Linux:
  1. Open Terminal in this folder.
  2. Run directly with: ./Start-NumerologySaaS.sh
  3. Or install with: ./bin/install-macos-linux.sh
  4. Open http://127.0.0.1:8000 in your browser.

Default admin login:
  Email: admin@example.com
  Password: password123

Requirement: PHP 8.1+ with SQLite extensions enabled.
TXT

(
  cd "$DIST_DIR"
  zip -qr "$ZIP_FILE" "$PACKAGE_NAME"
)

echo "Created package: $ZIP_FILE"
echo "Send this ZIP to your local PC, extract it, and open START-HERE.txt."
