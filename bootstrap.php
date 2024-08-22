<?php

declare(strict_types=1);

require __DIR__.'/vendor/autoload.php';

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();