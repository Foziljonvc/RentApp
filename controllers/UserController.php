<?php

declare(strict_types=1);

namespace Shohjahon\RentController;
use Shohjahon\RentSrc\Ads;

class UserController
{
    public function loadProfile(): void
    {
        $ads = (new Ads())->getUsersAds($_SESSION['id']);
        require basePath('/resources/view/pages/profile.php');
    }
}