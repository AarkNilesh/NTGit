# Numerology SaaS

A multi-stack starter for a numerology SaaS product:

- **Standalone PHP** app matching the requested file flow.
- **Laravel-ready API** code for teams that want to migrate to Laravel.
- **React** front end for a modern SPA experience.

## Fastest local install and run

### Requirements

- PHP 8.1 or newer.
- PHP SQLite extensions enabled (`pdo_sqlite` and `sqlite3`).
- Node.js 20+ only if you want to run the optional React app.

### macOS / Linux / Git Bash on Windows

```bash
cd numerology-saas
./bin/run-local.sh
```

Open <http://127.0.0.1:8000> in your browser.

Default admin login:

- Email: `admin@example.com`
- Password: `password123`

You can override the admin account on first run:

```bash
./bin/run-local.sh --admin-email=you@example.com --admin-password='change-me-now'
```

### Windows Command Prompt / PowerShell

```bat
cd numerology-saas
bin\run-local.bat
```

Open <http://127.0.0.1:8000> in your browser.


## Create an executable local package for another PC

Use this when you want to send an installable ZIP to your local PC or a client machine. The package includes run scripts, setup scripts, and desktop-shortcut installers.

### Build the package on macOS / Linux / Git Bash

```bash
cd numerology-saas
./bin/create-package.sh
```

This creates:

```text
numerology-saas/dist/numerology-saas-local.zip
```

Copy that ZIP to your local PC, extract it, and open `START-HERE.txt`.

### Build the package on Windows

```bat
cd numerology-saas
bin\create-package.bat
```

This creates `dist\numerology-saas-local.zip`. Extract it on the target PC, then double-click `Start-NumerologySaaS.bat` to run it immediately or double-click `bin\install-windows.bat` to install a local copy and create a desktop shortcut.

> Note: this is a local web-app package, not a signed native Windows `.exe`. PHP 8.1+ must be installed on the target PC and available in `PATH`.

## Manual PHP flow

If you do not want to use the helper script:

```bash
cd numerology-saas
php bin/setup-local.php
php -S 127.0.0.1:8000 -t .
```

The standalone PHP app uses SQLite at `storage/numerology.sqlite` and creates tables automatically.

## Product flow

1. Register or login.
2. Add a client profile with name, date of birth, contact details, and notes.
3. Generate a numerology report with Life Path, Destiny, Soul Urge, and Personality numbers.
4. Record payment and revenue.
5. Download an HTML/PDF report or share a WhatsApp report link.

## React flow

```bash
cd numerology-saas/react
npm install
npm run dev
```

## Laravel flow

Copy the `laravel/app`, `laravel/routes`, and `laravel/database` files into a Laravel project, then run migrations. The Laravel controller exposes JSON endpoints for clients, reports, and payments.
