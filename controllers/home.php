<?php

declare(strict_types=1);

$ads = (new \Shohjahon\RentSrc\Ads())->getAds();

loadView('home', ['ads' => $ads]);