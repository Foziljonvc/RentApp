<?php

declare(strict_types=1);

use App\Router;

Router::get('/login', fn() => require basePath('/public/auth/login.php'));
Router::get('/register', fn() => require basePath('/public/auth/register.php'));

Router::post('/loginAd', function() {
    $response = (new \App\User())->checkUser($_POST['username'], $_POST['password']);
    if ($response){
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        unset($_SESSION['error']);
        redirect('/');
    } else {
        $_SESSION['error'] = "Username or password is incorrect";
        redirect('/login');
    }
});

Router::checkUser();

Router::get('/logOut', function (){
    session_destroy();
    redirect('/login');
});

Router::get('/delete', fn() => (new \App\Ads())->deleteAds((int)$_GET['id']));
Router::get('/', fn()=> loadController('home'));

Router::get('/ads/{id}', function (int $id) {
    loadController('showAd', ['id'=>$id]);
});

Router::get('/ads/create', fn()=> loadView('dashboard/create-ad'));
Router::post('/ads/create', function(){
    loadController('createAd');
});


Router::errorResponse(404, 'Not Found');
