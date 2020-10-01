<?php

namespace App\Http\Controllers;

use App\Http\Constants\common;
use App\Http\Requests\StoreUserRequest;
use App\Repositories\UserRepo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    private $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        return view('admin.user.index');
    }

    public function getAll()
    {
        try {
            $users = $this->userRepo->getAll();

            if (isset($users)) {
                return response()->json(['data' => $users]);
            }
            return abort(500);

        } catch (Exception $ex) {
            report($ex);
            return abort(500);
        }
    }

    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $user = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_type' => common::ROLES['GUEST'],
                'active' => true
            ];
            $this->userRepo->insert($user);
            DB::commit();
            return ['message' => 'import success'];
        } catch (Exception $ex) {
            DB::rollBack();
            return ['message' => $ex];
        }

    }
    public function removeUserById($id){
        try {
            $this->userRepo->deleteUserById($id);
            return ['message' =>  'delete user success'];
        }catch (Exception $ex){
            return ['message' => 'delete fail', 'error' => $ex];
        }
    }
}
