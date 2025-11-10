<?php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=' . ($_ENV['DB_HOST'] ?? 'db') . ';port=' . ($_ENV['DB_PORT'] ?? '5432') . ';dbname=' . ($_ENV['DB_NAME'] ?? 'fix-price-test'),
    'username' => $_ENV['DB_USER'] ?? 'fpuser',
    'password' => $_ENV['DB_PASS'] ?? 'fppass',
    'charset' => 'utf8',
];
