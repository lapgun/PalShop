<?php

namespace App\Repositories;

use App\User;

class UserRepo
{
    public function getAll()
    {
         return User::all();
    }
}
