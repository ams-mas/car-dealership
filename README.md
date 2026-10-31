# XAMPP development

Website: http://localhost:8080

Start Apache and MySQL in XAMPP Control Panel before opening the website. Both are currently running. Start-Preview.cmd opens the website in your default browser.

Project: dealership/
Apache document root: dealership/public/
Apache configuration: xampp/dealership.conf (included by E:/xampp/apache/conf/extra/httpd-vhosts.conf).
The previous virtual-host configuration was backed up beside that file before adding the include. The dealership listener accepts local connections only. Existing port 80 configuration is preserved.

Laravel uses XAMPP PHP at E:/xampp/php/php.exe and the separate dealership_local database. Existing databases and the earlier SQLite file are preserved. The local .env is ignored by Git; .env.example contains local setup defaults without a key. XAMPP's default root account is for local development only.

After pulling new migrations, run from dealership:
    E:/xampp/php/php.exe artisan migrate

Build frontend assets from dealership:
    node ../package/bin/npm-cli.js run build
Or, with a standard npm installation:
    npm install
    npm run build

Implemented: Laravel 12, Blade, HTML/CSS, built Tailwind and Alpine.js, responsive design preview, make filtering, and expandable fictional listings. Vehicle records are still embedded in the view. Database-backed inventory, owner authentication, inquiries, API, uploads, backups, and production deployment are not yet implemented.

XAMPP currently provides PHP 8.2.12. Upgrade to PHP 8.3+ before meeting the production specification. No website deployment was performed.

Verified: Apache syntax check; MySQL migrations; starter tests (2 passed); HTTP 200 through Apache; Porsche filter response. Browser visual inspection remains pending.

## Set up from GitHub

1. Clone this repository and open a terminal in `dealership`.
2. Run `composer install`.
3. Copy `.env.example` to `.env`, then run `php artisan key:generate`.
4. Start MySQL in XAMPP. Create a `dealership_local` database in phpMyAdmin, or run `php ../xampp/create-database.php` for an unchanged local XAMPP root account.
5. Check the database credentials in `.env`, then run `php artisan migrate`.
6. Install Node.js/npm, then run `npm ci` and `npm run build`.
7. Edit the absolute project path in `xampp/dealership.conf` to match your checkout. Add an `Include` for that file to XAMPP's `apache/conf/extra/httpd-vhosts.conf`, then restart Apache. The provided configuration uses port 8080 and requires `mod_rewrite`.
8. Open http://localhost:8080.

Do not upload `.env` or database files. Production deployment requires its own environment configuration and credentials.

Compiled frontend assets in dealership/public/build are included in GitHub. Rebuild them after changing frontend source. Composer and npm dependencies are restored using the committed lockfiles; local environment files, databases, caches, and logs are not uploaded.

## Included database and dependencies

The repository includes vendor/ and node_modules/ as explicitly requested. The bundled Node dependencies were installed on Windows; run npm ci on other operating systems. Lockfiles remain the source for reproducible dependency installation.

Database exports: dealership/database/xampp-schema.sql and xampp-migration-data.sql. Import the schema, then migration data into a new empty local database. These exports exclude active sessions, account credentials, cache contents, and queued payloads. No inventory or user records existed at export time. Do not import them over an existing database with data you need.

No application log files existed at upload time; storage/logs/README.md records that state. The local .env and live SQLite/session data are not included.
