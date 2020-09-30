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
    public function getAll(){
        return User::all();
    }
    public function deleteUserById($id){
        return User::query()->where('id', $id)->delete();
    }
}
