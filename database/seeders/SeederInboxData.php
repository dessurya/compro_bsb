<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inbox;

class SeederInboxData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <= 25; $i++) { 
            Inbox::create([
                'name' => 'name-'.$i,
                'email' => 'email-'.$i.'@mail.dummy',
                'subject' => 'subject-'.$i,
                'message' => 'dummy message '.$i,
            ]);
        }
    }
}
