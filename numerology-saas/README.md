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
