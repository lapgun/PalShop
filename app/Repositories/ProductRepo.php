<?php


namespace App\Repositories;


use App\Model\Product;

class ProductRepo
{
    public function getAll($request)
    {
        $query = Product::query();
        if (!is_null($request['textSearch'])) {
            $query->where('name', 'LIKE', '%' . $request['textSearch'] . '%');
            $query->orWhere('description', 'LIKE', '%' . $request['textSearch'] . '%');
            $query->orWhere('model', 'LIKE', '%' . $request['textSearch'] . '%');
            $query->orWhere('size', 'LIKE', '%' . $request['textSearch'] . '%');
            $query->orWhere('weight', 'LIKE', '%' . $request['textSearch'] . '%');
            $query->orWhere('price', 'LIKE', '%' . $request['textSearch'] . '%');
            $query->orWhere('quality', 'LIKE', '%' . $request['textSearch'] . '%');
        }
        $query->orderBy('id', 'desc');
        return $query->paginate($request['limit']);
    }
}
