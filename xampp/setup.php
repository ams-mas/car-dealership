<?php
// Run with XAMPP PHP: php xampp/setup.php [http://localhost/car-dealership/public]
declare(strict_types=1);
$root = dirname(__DIR__);
chdir($root);
if (!is_file($root.'/vendor/autoload.php')) { fwrite(STDERR, "Dependencies missing. Run composer install first.\n"); exit(1); }
if (!is_file($root.'/.env')) {
    $url = $argv[1] ?? 'http://localhost/'.rawurlencode(basename($root)).'/public';
    if (!filter_var($url, FILTER_VALIDATE_URL)) { fwrite(STDERR, "Invalid local URL.\n"); exit(1); }
    $example = file_get_contents($root.'/.env.example');
    $example = preg_replace('/^APP_URL=.*$/m', 'APP_URL='.$url, $example);
    file_put_contents($root.'/.env', $example);
    echo "Created local .env. Existing environment files are never overwritten.\n";
}
require $root.'/vendor/autoload.php';
$app = require $root.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
try {
    $kernel->bootstrap();
    if (config('database.default') !== 'mysql') { throw new RuntimeException('Set DB_CONNECTION=mysql in .env.'); }
    $db = config('database.connections.mysql');
    $name = $db['database'];
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $name)) { throw new RuntimeException('Use letters, numbers and underscores in DB_DATABASE.'); }
    $pdo = new PDO('mysql:host='.$db['host'].';port='.$db['port'].';charset=utf8mb4', $db['username'], $db['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->exec('CREATE DATABASE IF NOT EXISTS `'.$name.'` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    if (!config('app.key')) {
        $code = $kernel->call('key:generate', ['--force' => true]);
        echo $kernel->output();
        if ($code !== 0) { exit($code); }
    }
    $code = $kernel->call('migrate', ['--force' => true]);
    echo $kernel->output();
    if ($code !== 0) { exit($code); }
    echo 'Ready: '.config('app.url')."\n";
} catch (Throwable $error) {
    fwrite(STDERR, "Setup failed. Start MySQL in XAMPP and check DB_* in .env.\n".$error->getMessage()."\n");
    exit(1);
}
