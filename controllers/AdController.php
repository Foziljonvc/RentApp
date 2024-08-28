<?php

declare(strict_types=1);

namespace Shohjahon\RentController;

use JetBrains\PhpStorm\NoReturn;
use Shohjahon\RentSrc\Ads;
use Shohjahon\RentSrc\Image;

class AdController
{
    public function showOneAd(int $id): void
    {
        /**
         * @var $id
         */

        $ad = (new Ads())->getAd($id);

        loadView('single-ad', ['ad' => $ad]);
    }

    public function createAdInfo(): void
    {
        $requiredFields = ['title', 'description', 'price', 'address', 'rooms'];

        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                exit("Iltimos, barcha maydonlarni to'ldiring!");
            }
        }

        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = (float)$_POST['price'];
        $branch = (int)$_POST['branch'];
        $address = $_POST['address'];
        $rooms = (int)$_POST['rooms'];

        $newAdsId = (new Ads())->createAds(
            $title,
            $description,
            6,
            1,
            1,
            $address,
            $price,
            $rooms
        );

        if ($newAdsId) {
            $this->checkAdImage((int)$newAdsId);
        }
    }

    #[NoReturn] private function checkAdImage(int $newAdsId): void
    {
        $imageHandler = new Image();
        $fileName = $imageHandler->handleUpload();

        if (!$fileName) {
            exit('Rasm yuklanmadi!');
        }

        $imageHandler->addImage($newAdsId, $fileName);

        header('Location: /');
        exit();
    }
}
