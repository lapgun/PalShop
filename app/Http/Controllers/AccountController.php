<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepo;
use Exception;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {

        try {
            $users = $this->userRepo->getAll();
            if (isset($users)){
                return response()->json([
                    'msg' => 'Success',
                    'data' => $users
                ]);
            }
            return response()->json([
                'msg' => 'Fail'
            ]);

        } catch (Exception $ex) {
            report($ex);
            return abort(500);
        }
    }
}
