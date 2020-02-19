<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->where('email','ahmed@gmail.com')->first();

        if(!$user){
            User::create([
                'name'       => 'Ahmed',
                'email'      => 'ahmed@gmail.com',
                'password'   =>  Hash::make('12345678'),
                'role'       =>  'admin'
            ]);
        }
    }
}
