<?php


namespace App\Repositories;


use App\Model\Product;

class ProductRepo
{
    public function getAll($request)
    {
        $query = Product::with('images');
        if (!is_null($request['textSearch'])) {
            $query->where(function ($q) use ($request) {
                $q->orWhere('name', 'LIKE', '%' . $request['textSearch'] . '%')
                    ->orWhere('description', 'LIKE', '%' . $request['textSearch'] . '%')
                    ->orWhere('model', 'LIKE', '%' . $request['textSearch'] . '%')
                    ->orWhere('size', 'LIKE', '%' . $request['textSearch'] . '%')
                    ->orWhere('weight', 'LIKE', '%' . $request['textSearch'] . '%')
                    ->orWhere('price', 'LIKE', '%' . $request['textSearch'] . '%')
                    ->orWhere('quality', 'LIKE', '%' . $request['textSearch'] . '%');
            });
        }
        $query->orderBy('id', 'desc');
        return $query->paginate($request['limit']);
    }

    public function create($data)
    {
        return Product::query()->insertGetId($data);
    }

    public function deleteById($id)
    {
        return Product::query()->where('id', $id)->delete();
    }

    public function getProductById($id)
    {
        return Product::query()->with('images')->where('id', $id)->first();
    }
}
