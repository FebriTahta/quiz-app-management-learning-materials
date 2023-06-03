<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usr = [
            [
                'username' => "admin",
                'role' => "admin",
                'password'   => bcrypt("admin"),
                'pass' => "admin",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];

        $cek_user = User::where('username','admin')->first();
        if ($cek_user == null) {
            # code...
            User::insert($usr);
        }
    }
}
