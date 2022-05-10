<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NavigationConfig;

class SeederNavigationConfig extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setDefData = [
            [
                'identity' => 'Home',
                'name' => ['id' => 'Beranda', 'en' => 'Home'],
                'position' => 1,
            ],
            [
                'identity' => 'About Us',
                'name' => ['id' => 'Tentang Kami', 'en' => 'About Us'],
                'position' => 2,
            ],
            [
                'identity' => 'Our Product',
                'name' => ['id' => 'Produk Kami', 'en' => 'Our Product'],
                'position' => 3,
            ],
            [
                'identity' => 'Sustainability',
                'name' => ['id' => 'Sustainability', 'en' => 'Sustainability'],
                'position' => 4,
            ],
            [
                'identity' => 'Our Client',
                'name' => ['id' => 'Our Client', 'en' => 'Our Client'],
                'position' => 5,
            ],
            [
                'identity' => 'News & Info',
                'name' => ['id' => 'News & Info', 'en' => 'News & Info'],
                'position' => 6,
            ],
            [
                'identity' => 'Investor',
                'name' => ['id' => 'Investor', 'en' => 'Investor'],
                'position' => 7,
            ],
            [
                'identity' => 'Career',
                'name' => ['id' => 'Career', 'en' => 'Career'],
                'position' => 8,
            ],
            [
                'identity' => 'Contact Us',
                'name' => ['id' => 'Contact Us', 'en' => 'Contact Us'],
                'position' => 9,
            ],
        ];

        foreach ($setDefData as $key => $arr) {
            NavigationConfig::updateOrCreate(
                ['identity', $arr['identity']],
                $arr
            );
        }
    }
}
