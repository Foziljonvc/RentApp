<?php

declare(strict_types=1);

use Shohjahon\RentApp\Router;

$router = new Router();

$router->get('/ads', fn() => location('/public/pages/home.php'));
$router->get('/home', fn() => location('/public/pages/home.php'));
$router->get('/users', fn() => location('/public/pages/user.php'));
$router->get('/branches', fn() => location('/public/pages/branch.php'));
$router->get('/statuses', fn() => location('/public/pages/status.php'));
$router->get('/showAd', fn() => location('/public/contentPages/showAd.php'));

$router->notFount('/public/partials/errors.php');