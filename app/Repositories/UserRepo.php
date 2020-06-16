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
}
