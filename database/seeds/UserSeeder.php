<?php

use App\Http\Constants\common;
use App\Repositories\UserRepo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    private $userRepo;
     public function __construct(UserRepo $userRepo)
     {
         $this->userRepo = $userRepo;
     }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->userRepo->deleteAll();
        $this->userRepo->insert([
            'name' => "admin",
            'password' => Hash::make(12345678),
            'role_type' => Common::ROLES['SUPER'],
            'email' => 'lapph@vnext.com.vn',
        ]);
    }
}
