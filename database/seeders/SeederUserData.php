<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class SeederUserData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = [
            ['name' => 'Adam Surya Des', 'email' => 'fourline66@gmail.com', 'password' => 'asdasd', 'flag_active' => 'Y', 'flag_notif_inbox' => 'Y']
        ];
        
        foreach ($stores as $store) { User::updateOrCreate(['email' => $store['email']],$store); }
    }
}
