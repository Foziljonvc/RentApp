<?php

declare(strict_types=1);

use App\Router;

Router::get('/login', function () {
    if (isset($_SESSION['username'])) {
        redirect('/');
    }
    require basePath('/public/auth/login.php');
});

Router::get('/register', function () {
    if (isset($_SESSION['username'])) {
        redirect('/');
    }
    require basePath('/public/auth/register.php');
});

Router::post('/loginAd', function() {
    $response = (new \App\Auth())->checkUserLogin($_POST['username'], $_POST['password']);
    if ($response) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        unset($_SESSION['error_login']);
        redirect('/');
    } else {
        $_SESSION['error_login'] = "Username or password is incorrect";
        redirect('/login');
    }
});

Router::post('/registerAd', function () {
    $response = (new \App\Auth())->checkUserRegister($_POST['phone']);
    if (!$response) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        unset($_SESSION['error_register']);
        (new \App\User())->createUser(
            $_POST['username'],
            $_POST['position'],
            $_POST['gender'],
            $_POST['phone'],
            $_POST['password']
        );
        redirect('/');
    } else {
        $_SESSION['error_register'] = "Username, phone, or password is incorrect";
        redirect('/register');
    }
});

Router::get('/logOut', function (){
    session_destroy();
    redirect('/login');
});

// Main routes
Router::get('/', function () {
    if (!isset($_SESSION['username'])) {
        redirect('/login');
    }
    loadController('home');
});

Router::get('/temp', function () {
    if (!isset($_SESSION['username'])) {
        redirect('/login');
    }
    loadView('temp');
});

Router::get('/documentation', function () {
    if (!isset($_SESSION['username'])) {
        redirect('/login');
    }
    loadView('documentation');
});

// Ads routes
Router::get('/ads/{id}', function (int $id) {
    if (!isset($_SESSION['username'])) {
        redirect('/login');
    }
    loadController('showAd', ['id' => $id]);
});

Router::get('/ads/create', function () {
    if (!isset($_SESSION['username'])) {
        redirect('/login');
    }
    loadView('dashboard/create-ad');
});

Router::post('/ads/create', function(){
    if (!isset($_SESSION['username'])) {
        redirect('/login');
    }
    loadController('createAd');
});

Router::get('/delete', function () {
    if (!isset($_SESSION['username'])) {
        redirect('/login');
    }
    (new \App\Ads())->deleteAds((int)$_GET['id']);
});

Router::get('/dashboard', function () {
    if (!isset($_SESSION['username'])) {
        redirect('/login');
    }
    loadView('dashboard/Admin');
});

Router::errorResponse(404, 'Not Found');