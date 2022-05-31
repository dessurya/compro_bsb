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
                'meta_author' => 'BSB',
                'meta_title' => json_encode(['id' => null, 'en' => null]),
                'meta_description' => json_encode(['id' => null, 'en' => null]),
                'meta_keywords' => json_encode(['id' => null, 'en' => null]),
            ],
            [
                'identity' => 'About Us',
                'name' => json_encode(['id' => 'Tentang Kami', 'en' => 'About Us']),
                'position' => 2,
                'meta_author' => 'BSB',
                'meta_title' => json_encode(['id' => null, 'en' => null]),
                'meta_description' => json_encode(['id' => null, 'en' => null]),
                'meta_keywords' => json_encode(['id' => null, 'en' => null]),
            ],
            [
                'identity' => 'Our Product',
                'name' => json_encode(['id' => 'Produk Kami', 'en' => 'Our Product']),
                'position' => 3,
                'meta_author' => 'BSB',
                'meta_title' => json_encode(['id' => null, 'en' => null]),
                'meta_description' => json_encode(['id' => null, 'en' => null]),
                'meta_keywords' => json_encode(['id' => null, 'en' => null]),
            ],
            [
                'identity' => 'Sustainability',
                'name' => json_encode(['id' => 'Sustainability', 'en' => 'Sustainability']),
                'position' => 4,
                'meta_author' => 'BSB',
                'meta_title' => json_encode(['id' => null, 'en' => null]),
                'meta_description' => json_encode(['id' => null, 'en' => null]),
                'meta_keywords' => json_encode(['id' => null, 'en' => null]),
            ],
            [
                'identity' => 'Our Client',
                'name' => json_encode(['id' => 'Klien Kami', 'en' => 'Our Client']),
                'position' => 5,
                'meta_author' => 'BSB',
                'meta_title' => json_encode(['id' => null, 'en' => null]),
                'meta_description' => json_encode(['id' => null, 'en' => null]),
                'meta_keywords' => json_encode(['id' => null, 'en' => null]),
            ],
            [
                'identity' => 'News & Info',
                'name' => json_encode(['id' => 'Berita & Info', 'en' => 'News & Info']),
                'position' => 6,
                'meta_author' => 'BSB',
                'meta_title' => json_encode(['id' => null, 'en' => null]),
                'meta_description' => json_encode(['id' => null, 'en' => null]),
                'meta_keywords' => json_encode(['id' => null, 'en' => null]),
            ],
            [
                'identity' => 'Investor',
                'name' => json_encode(['id' => 'Investor', 'en' => 'Investor']),
                'position' => 7,
                'meta_author' => 'BSB',
                'meta_title' => json_encode(['id' => null, 'en' => null]),
                'meta_description' => json_encode(['id' => null, 'en' => null]),
                'meta_keywords' => json_encode(['id' => null, 'en' => null]),
            ],
            [
                'identity' => 'Career',
                'name' => json_encode(['id' => 'Karier', 'en' => 'Career']),
                'position' => 8,
                'meta_author' => 'BSB',
                'meta_title' => json_encode(['id' => null, 'en' => null]),
                'meta_description' => json_encode(['id' => null, 'en' => null]),
                'meta_keywords' => json_encode(['id' => null, 'en' => null]),
            ],
            [
                'identity' => 'Contact Us',
                'name' => json_encode(['id' => 'Hubungin Kami', 'en' => 'Contact Us']),
                'position' => 9,
                'meta_author' => 'BSB',
                'meta_title' => json_encode(['id' => null, 'en' => null]),
                'meta_description' => json_encode(['id' => null, 'en' => null]),
                'meta_keywords' => json_encode(['id' => null, 'en' => null]),
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
