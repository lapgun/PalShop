<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Repositories\ImageRepo;
use App\Repositories\ProductRepo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $productRepo;
    private $imageRepo;

    public function __construct(ProductRepo $productRepo, ImageRepo $imageRepo)
    {
        $this->productRepo = $productRepo;
        $this->imageRepo = $imageRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.product.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function getAll(Request $request)
    {
        $req = $request->all();
        try {
            $products = $this->productRepo->getAll($req);
            if (isset($products)) {
                $products->getCollection()->transform(function ($product) {
                    $product->images->transform(function ($image) {
                        $image->full_url_link = Storage::url($image->url_link);
                        return $image;
                    });
                    return $product;
                });
                return response()->json(['data' => $products]);
            }
            return abort(500);

        } catch (Exception $ex) {
            report($ex);
            return abort(500);
        }
    }

    /**
     * @param Request $request
     * @return array|void
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $product['name'] = $request->get('name');
            $product['model'] = $request->get('model');
            $product['description'] = $request->get('description');
            $product['weight'] = $request->get('weight');
            $product['size'] = $request->get('size');
            $product['quality'] = $request->get('quality');
            $product['price'] = $request->get('price');

            DB::beginTransaction();

            $productId = $this->productRepo->create($product);

            if (isset($productId)) {
                $images = [];
                if ($files = $request->file('image')) {
                    foreach ($files as $file) {
                        $type = $file->getClientMimeType();
                        $name = $file->getClientOriginalName();

                        $imagePath = Storage::putFileAs('', $file, $name);

                        $images[] = [
                            'url_link' => $imagePath,
                            'product_id' => $productId,
                            'type' => $type
                        ];
                    }
                }
                $this->imageRepo->insertImageByProductId($images);
            }

            DB::commit();

            return [
                'message' => 'success',
                'status' => '200'
            ];
        } catch (Exception $ex) {
            DB::rollBack();
            report($ex);
            return abort(500);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.product.create');
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $images = $this->imageRepo->getImagesByProductId($id);

            $listUrl = $images->pluck('url_link');
            foreach ($listUrl as $url){
                Storage::delete($url);
            }

            $this->productRepo->deleteById($id);
            $this->imageRepo->deleteImagesByProductId($id);
            DB::commit();
            return [
                'message' => 'success',
                'status' => '200'
            ];
        } catch (Exception $ex) {
            dd($ex);
            report($ex);
            return abort(500);
        }
    }

}
