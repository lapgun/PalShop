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

    public function index(){

        try {
            $users = $this->userRepo->getAll();

            if (isset($users)){
                return view('admin.user.index')->with(compact('users'));
            }
            return abort(500);

        } catch (Exception $ex) {
            report($ex);
            return abort(500);
        }
    }

    public function adminIndex(){
        return view('admin.user.index');
    }
}
