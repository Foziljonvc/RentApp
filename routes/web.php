<?php

declare(strict_types=1);

use Shohjahon\RentController\AdController;
use Shohjahon\RentController\AuthController;
use Shohjahon\RentController\UserController;
use Shohjahon\RentSrc\Ads;
use Shohjahon\RentSrc\Router;

Router::get('/', fn() => loadController('home'));

Router::get('/login', fn() => loadView('auth/login'), 'guest');
Router::get('/register', fn() => loadView('auth/register'), 'guest');

Router::post('/loginAd', fn() => (new AuthController())->enterUserWithLogin());
Router::post('/registerAd', fn() => (new AuthController())->enterUserWithRegister());
Router::get('/logOut', fn() => (new AuthController())->logOut());

Router::get('/ads/{id}', fn(int $id) => (new AdController())->showOneAd($id));
Router::get('/ads/create', fn() => loadView('dashboard/create-ad'), 'auth');
Router::post('/ads/create', fn() => (new AdController())->createAdInfo(), 'auth');

Router::get('/temp', fn() => loadController('temp'));
Router::get('/documentation', fn() => loadView('documentation'));
Router::get('/delete', fn() => (new Ads())->deleteAds((int)$_GET['id']));

// Adminligini tekshirish
Router::get('/profile', fn() => (new UserController())->loadProfile(), 'auth');

Router::errorResponse(404, 'Not Found');