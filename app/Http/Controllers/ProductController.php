<?php

namespace App\Http\Controllers;

use App\Repositories\ImageRepo;
use App\Repositories\ProductRepo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $product = $this->productRepo->getAll($req);
            if (isset($product)) {
                return response()->json(['data' => $product]);
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
    public function store(Request $request)
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
                        $file->move('storage/app/public', $name);
                        $images[] = [
                            'url_link' => 'storage/app/public/' . $name,
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

}
