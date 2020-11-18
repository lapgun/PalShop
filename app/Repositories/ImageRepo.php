<?php


namespace App\Repositories;

use App\Model\Image;

class ImageRepo
{
    public function insertImageByProductId($images)
    {
        return Image::query()->insert($images);
    }

    public function getImagesByProductId($id)
    {
        return Image::query()->where('product_id', $id)->get();
    }

    public function deleteImagesByProductId($id)
    {
        return Image::query()->where('product_id', $id)->delete();
    }
}
