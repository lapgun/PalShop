<?php

namespace App\Repositories;
use App\User;

class UserRepo
{
    public function insert($data)
    {
        return User::query()->insert($data);
    }
    public function deleteAll()
    {
        return User::query()->delete();
    }
    public function getAll($request){
        $query = User::query();
        if(!is_null($request['textSearch'])){
            $query->where('name', 'LIKE', '%' . $request['textSearch'] . '%');
            $query->orWhere('email', 'LIKE', '%' . $request['textSearch'] . '%');
        }
        $query->orderBy('id','desc');
        return $query->paginate($request['limit']);
    }
    public function deleteUserById($id){
        return User::query()->where('id', $id)->delete();
    }
    public function updateUserById($data){
        return User::query()->find($data['id'])->update([
            'role_type' => $data['role'],
            'active' => $data['status']
        ]);
    }
}
