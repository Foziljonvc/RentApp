<?php

declare(strict_types=1);

$ads = (new \Shohjahon\RentApp\Ads())->getAds();

loadView('home', ['ads' => $ads]);