<?php


namespace App\Repositories;

use App\Model\Image;

class ImageRepo
{
    public function insertImageByProductId($images)
    {
        return Image::query()->insert($images);
    }
}
