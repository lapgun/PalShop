<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepo;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepo;

    public function __construct(ProductRepo $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function index()
    {
        return view('admin.product.index');
    }

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

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function create()
    {
        return view('admin.product.create');
    }

}
