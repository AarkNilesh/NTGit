# Numerology SaaS

A multi-stack starter for a numerology SaaS product:

- **Standalone PHP** app matching the requested file flow.
- **Laravel-style API** code for teams that want to migrate to Laravel.
- **React** front end for a modern SPA experience.

## PHP flow

1. Register or login.
2. Add a client profile with name, date of birth, contact details, and notes.
3. Generate a numerology report with Life Path, Destiny, Soul Urge, and Personality numbers.
4. Record payment and revenue.
5. Download an HTML/PDF report or share a WhatsApp report link.

Run locally from the `numerology-saas` directory:

```bash
php -S 127.0.0.1:8000
```

The app uses SQLite at `storage/numerology.sqlite` and creates tables automatically.

## React flow

```bash
cd react
npm install
npm run dev
```

## Laravel flow

Copy the `laravel/app`, `laravel/routes`, and `laravel/database` files into a Laravel project, then run migrations. The Laravel controller exposes JSON endpoints for clients, reports, and payments.
