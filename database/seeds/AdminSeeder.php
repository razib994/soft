<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::where('email', 'razibeee2016@gmail.com')->first();
        if(is_null($admin)) {
            $admin = new Admin();
            $admin->name     = 'Superadmin';
            $admin->email    = 'razibeee2016@gmail.com';
            $admin->username = 'superman';
            $admin->password = Hash::make('12345678');
            $admin->save();
        }
    }
}
