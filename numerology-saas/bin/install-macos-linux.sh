#!/usr/bin/env bash
set -euo pipefail

SOURCE_DIR="$(cd "$(dirname "$0")/.." && pwd)"
INSTALL_DIR="${NUMEROLOGY_INSTALL_DIR:-$HOME/Applications/numerology-saas}"
LAUNCHER="$INSTALL_DIR/bin/run-local.sh"

command -v php >/dev/null 2>&1 || {
  echo "PHP is required but was not found in PATH. Install PHP 8.1+ and run this installer again." >&2
  exit 1
}

mkdir -p "$(dirname "$INSTALL_DIR")"
rm -rf "$INSTALL_DIR"
mkdir -p "$INSTALL_DIR"

rsync -a \
  --exclude 'dist/' \
  --exclude 'storage/*.sqlite' \
  --exclude 'storage/*.sqlite-*' \
  --exclude 'vendor/' \
  --exclude 'react/node_modules/' \
  --exclude 'react/dist/' \
  "$SOURCE_DIR/" "$INSTALL_DIR/"

chmod +x "$INSTALL_DIR/bin/"*.sh
php "$INSTALL_DIR/bin/setup-local.php"

if [ -d "$HOME/Desktop" ]; then
  DESKTOP_LAUNCHER="$HOME/Desktop/Numerology SaaS.command"
  cat > "$DESKTOP_LAUNCHER" <<EOF
#!/usr/bin/env bash
cd "$INSTALL_DIR"
"$LAUNCHER"
EOF
  chmod +x "$DESKTOP_LAUNCHER"
  echo "Desktop launcher created: $DESKTOP_LAUNCHER"
fi

echo "Installed Numerology SaaS to: $INSTALL_DIR"
echo "Run it any time with: $LAUNCHER"
echo "Then open: http://127.0.0.1:8000"
