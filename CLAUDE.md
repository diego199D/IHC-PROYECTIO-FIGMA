# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project status

This is a stock, unmodified Laravel 12 skeleton (`laravel/laravel`) — no custom controllers, models, migrations, or views have been added yet beyond the framework defaults (`User` model, default `welcome` route/view). Treat any architectural description as "what Laravel provides by default," not project-specific convention, until real app code exists.

Not a git repository yet — there is no `.git` directory. If asked to commit, offer to run `git init` first.

## Stack

- PHP 8.2+, Laravel 12
- MySQL (`DB_DATABASE=proyecto1_ihc`) for local dev; SQLite in-memory for the test suite (configured in `phpunit.xml`)
- Session/cache/queue all driven through the `database` driver (see `.env`)
- Frontend build: Vite + Tailwind CSS v4 (`laravel-vite-plugin`, `@tailwindcss/vite`), no JS framework wired in — `resources/js/app.js` is the entry point
- PHPUnit 11 for tests (Pest is not installed)

## Commands

Run from the project root (PowerShell on this machine):

```
composer install                 # install PHP deps
npm install                      # install JS deps

php artisan migrate              # run migrations against MySQL (proyecto1_ihc)
php artisan serve                # dev server at APP_URL (http://localhost:8000)

npm run dev                      # Vite dev server (asset watch/HMR)
npm run build                    # production asset build

composer dev                     # runs php artisan serve + queue:listen + vite concurrently

composer test                    # clears config cache, then runs the full test suite
php artisan test                 # run tests directly
php artisan test --filter=TestName   # run a single test by method/class name
php artisan test tests/Feature/ExampleTest.php   # run a single test file

vendor/bin/pint                  # format PHP code (Laravel Pint)
vendor/bin/pint --test           # check formatting without writing changes
```

Tests use `DB_CONNECTION=sqlite` with `:memory:` (see `phpunit.xml`), so they don't touch the MySQL dev database.

## Structure notes

- PSR-4 autoload: `App\` → `app/`, `Database\Factories\` → `database/factories/`, `Database\Seeders\` → `database/seeders/`, `Tests\` → `tests/` (see `composer.json`)
- Routes: `routes/web.php` (HTTP) and `routes/console.php` (Artisan/scheduled commands) — no `routes/api.php` yet
- Tests split into `tests/Unit` and `tests/Feature` test suites (defined in `phpunit.xml`)
