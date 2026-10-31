<?php
$pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$pdo->exec('CREATE DATABASE IF NOT EXISTS dealership_local CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
echo "Local dealership database ready.\n";
