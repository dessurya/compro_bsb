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
                'name' => json_encode(['id' => 'Beranda', 'en' => 'Home']),
                'position' => 1,
            ],
            [
                'identity' => 'About Us',
                'name' => json_encode(['id' => 'Tentang Kami', 'en' => 'About Us']),
                'position' => 2,
            ],
            [
                'identity' => 'Our Product',
                'name' => json_encode(['id' => 'Produk Kami', 'en' => 'Our Product']),
                'position' => 3,
            ],
            [
                'identity' => 'Sustainability',
                'name' => json_encode(['id' => 'Sustainability', 'en' => 'Sustainability']),
                'position' => 4,
            ],
            [
                'identity' => 'Our Client',
                'name' => json_encode(['id' => 'Our Client', 'en' => 'Our Client']),
                'position' => 5,
            ],
            [
                'identity' => 'News & Info',
                'name' => json_encode(['id' => 'News & Info', 'en' => 'News & Info']),
                'position' => 6,
            ],
            [
                'identity' => 'Investor',
                'name' => json_encode(['id' => 'Investor', 'en' => 'Investor']),
                'position' => 7,
            ],
            [
                'identity' => 'Career',
                'name' => json_encode(['id' => 'Career', 'en' => 'Career']),
                'position' => 8,
            ],
            [
                'identity' => 'Contact Us',
                'name' => json_encode(['id' => 'Contact Us', 'en' => 'Contact Us']),
                'position' => 9,
            ],
        ];

        foreach ($setDefData as $key => $arr) {
            NavigationConfig::updateOrCreate(
                ['identity' => $arr['identity']],
                $arr
            );
        }
    }
}
