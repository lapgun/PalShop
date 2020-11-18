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

//        $query = Product::query()
//            ->join('images', 'products.id', '=', 'images.product_id')
//            ->select([
//                'products.id',
//                'products.name',
//                'products.description',
//                'products.model',
//                'products.size',
//                'products.weight',
//                'products.price',
//                'products.quality',
//                'images.product_id',
//                'images.url_link',
//            ]);
//        if (!is_null($request['textSearch'])) {
//            $query->where('name', 'LIKE', '%' . $request['textSearch'] . '%');
//            $query->orWhere('description', 'LIKE', '%' . $request['textSearch'] . '%');
//            $query->orWhere('model', 'LIKE', '%' . $request['textSearch'] . '%');
//            $query->orWhere('size', 'LIKE', '%' . $request['textSearch'] . '%');
//            $query->orWhere('weight', 'LIKE', '%' . $request['textSearch'] . '%');
//            $query->orWhere('price', 'LIKE', '%' . $request['textSearch'] . '%');
//            $query->orWhere('quality', 'LIKE', '%' . $request['textSearch'] . '%');
//        }
//
//        $query->groupBy('images.url_link','images.product_id');
//        $query->orderBy('id', 'desc');
//        dd($query->get()->toArray());
//        return $query->paginate($request['limit']);
    }

    public function create($data)
    {
        return Product::query()->insertGetId($data);
    }

    public function deleteById($id)
    {
        return Product::query()->where('id', $id)->delete();
    }
}
