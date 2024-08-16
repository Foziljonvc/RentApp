<?php

declare(strict_types=1);

namespace Shohjahon\RentApp;

use JetBrains\PhpStorm\NoReturn;
use PDO;

class Router
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function get($path, $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $path) {
            $callback();
            exit();
        }
    }

    public function post($path, $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $path) {
            $callback();
            exit();
        }
    }

    public function getAds(): false|array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM ads");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    #[NoReturn] public function notFount(string $path): void
    {
        http_response_code(response_code: 404);
        location($path);
        exit();
    }
}