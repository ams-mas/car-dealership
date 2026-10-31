# Car dealership — XAMPP local testing

Laravel lives at the repository root. You can clone directly into XAMPP htdocs; no extra dealership subfolder is required. The compiled frontend and installed dependencies are included.

## First setup

1. Start Apache and MySQL in XAMPP Control Panel.
2. Open a terminal in your XAMPP htdocs folder (for example E:\xampp\htdocs).
3. Run:

       git clone https://github.com/ams-mas/car-dealership.git
       cd car-dealership

4. Double-click Setup-XAMPP.cmd. It creates .env only if missing, generates an application key only if missing, creates dealership_local if necessary, and runs pending migrations. It preserves existing data and credentials. If MySQL uses a password, edit DB_PASSWORD in .env and rerun setup.
5. Open http://localhost/car-dealership/public/.

XAMPP Apache must have mod_rewrite enabled and AllowOverride All for htdocs (normal XAMPP defaults). The root .htaccess blocks private project folders and redirects the project root to public/. No virtual-host edit is needed when using htdocs. If Apache uses another port, add that port to the URL and APP_URL in .env.

## After pulling updates

From the repository folder:

    git pull origin main

Then run Setup-XAMPP.cmd again and refresh your browser. If Git reports local changes, preserve or commit them before pulling; do not discard your work. .env, logs, and runtime databases are ignored.

## Tests

From the repository root:

    E:\xampp\php\php.exe vendor/phpunit/phpunit/phpunit

Adjust the PHP path for your XAMPP installation. Test the showroom at desktop/mobile widths, select a make, click Find a vehicle, reset the filter, and expand vehicle details. The data is fictional. Full inventory management, admin login, and inquiry submissions are not implemented yet.

## Frontend changes

Built CSS and JavaScript are committed, so Node is not needed to view the current website. To change frontend source, use a standard Node/npm installation:

    npm ci
    npm run build

Bundled node_modules were installed on Windows. Run npm ci for a different platform. Composer dependencies are included; run composer install when composer.lock changes. Lockfiles describe the required dependency versions.

## Database and local configuration

Use migrations for normal setup. database/xampp-schema.sql and xampp-migration-data.sql are optional snapshots for a new empty database; never import over data you need. Active sessions and credentials are excluded. No inventory or user records existed in the export. No application logs existed at snapshot time.

.env contains local credentials and must remain private. The default example uses XAMPP's local root account with an empty password. XAMPP currently has PHP 8.2; this preview supports it. The full production specification requires PHP 8.3+.

## Existing checkout from the earlier folder layout

After pulling, Laravel files move from dealership/ to the root. If you have an existing ignored dealership/.env, copy it to the root .env before setup to preserve its configuration. Existing vendor and node_modules remnants can remain until you confirm everything works. A custom Apache virtual host must point to the new root/public folder. The tracked xampp/dealership.conf is only for the original workstation; the htdocs setup above is portable.

The original development workstation still uses http://localhost:8080 via its custom virtual host. Nothing is deployed by these instructions.
