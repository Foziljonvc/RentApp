<?php

declare(strict_types=1);

use Shohjahon\RentApp\Router;

Router::get('/', fn()=> loadController('home'));

Router::get('/ads/{id}', function (int $id) {
    loadController('showAd', ['id'=>$id]);
});

Router::get('/ads/create', fn()=> loadView('dashboard/create-ad'));

Router::post('/ads/create', fn()=> loadController('createAd'));