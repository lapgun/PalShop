<?php


namespace App\Repositories;


use App\Model\Product;

class ProductRepo
{
    public function getAll($request)
    {
        $query = Product::with('images');
        if (!is_null($request['textSearch'])) {
            $query->where(function($q) use ($request) {
                $q->orWhere('name', 'LIKE', '%' . $request['textSearch'] . '%');
                $q->orWhere('description', 'LIKE', '%' . $request['textSearch'] . '%');
                $q->orWhere('model', 'LIKE', '%' . $request['textSearch'] . '%');
                $q->orWhere('size', 'LIKE', '%' . $request['textSearch'] . '%');
                $q->orWhere('weight', 'LIKE', '%' . $request['textSearch'] . '%');
                $q->orWhere('price', 'LIKE', '%' . $request['textSearch'] . '%');
                $q->orWhere('quality', 'LIKE', '%' . $request['textSearch'] . '%');
            });
        }
        $query->orderBy('id', 'desc');
        return $query->paginate($request['limit']);

//        $query = Product::query()
//            ->join('images', 'products.id', '=', 'images.product_id');
//        if (!is_null($request['textSearch'])) {
//            $query->where('name', 'LIKE', '%' . $request['textSearch'] . '%');
//            $query->orWhere('description', 'LIKE', '%' . $request['textSearch'] . '%');
//            $query->orWhere('model', 'LIKE', '%' . $request['textSearch'] . '%');
//            $query->orWhere('size', 'LIKE', '%' . $request['textSearch'] . '%');
//            $query->orWhere('weight', 'LIKE', '%' . $request['textSearch'] . '%');
//            $query->orWhere('price', 'LIKE', '%' . $request['textSearch'] . '%');
//            $query->orWhere('quality', 'LIKE', '%' . $request['textSearch'] . '%');
//        }
//        $query->groupBy('images.product_id');
//        $query->orderBy('id', 'desc');
//        return $query->paginate($request['limit']);
    }

    public function create($data)
    {
        return Product::query()->insertGetId($data);
    }
}
