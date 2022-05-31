<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sustainability;

class SeederSustainabilityData extends Seeder
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
                'title' => 'Manusia',
                'language' => 'id',
                'position' => 1,
                'content_shoert' => 'Sebuah bisnis tidak hanya memberikan pengaruh kepada pemilik, karyawan dan customer. Akan tetapi di dalam bisnis harus adanya kolaborasi dan sinergi yang dibangun antar stakeholder, karyawan, customer dan masyarakat sekitar lokasi untuk menciptakan sumber daya manusia yang tangguh dan kesejahteraan guna mendukung dan membantu masyarakat',
                'flag_publish' => 'Y',
            ],
            [
                'title' => 'Bumi',
                'language' => 'id',
                'position' => 2,
                'content_shoert' => 'Lingkungan sangat erat kaitannya dengan aspek kehidupan dan manusia, seperti air, dan udara. PT. Bima Sakti Bahari berkomitmen untuk meningkatkan kesehatan planet dengan aktivitas-aktivitas yang mendukung pelestarian, perlindungan lingkungan dan sumber daya alam guna menjaga kesehatan, kenyamanan dan ketersediaan sumberdaya alam untuk anak cucu di masa depan',
                'flag_publish' => 'Y',
            ],
            [
                'title' => 'Keuntungan',
                'language' => 'id',
                'position' => 3,
                'content_shoert' => 'Kami tidak hanya mengejar keuntungan. tetapi reputasi yang layak dibanggakan bangsa dan negara',
                'flag_publish' => 'Y',
            ],
            [
                'title' => 'People',
                'language' => 'en',
                'position' => 1,
                'content_shoert' => 'Sebuah bisnis tidak hanya memberikan pengaruh kepada pemilik, karyawan dan customer. Akan tetapi di dalam bisnis harus adanya kolaborasi dan sinergi yang dibangun antar stakeholder, karyawan, customer dan masyarakat sekitar lokasi untuk menciptakan sumber daya manusia yang tangguh dan kesejahteraan guna mendukung dan membantu masyarakat',
                'flag_publish' => 'Y',
            ],
            [
                'title' => 'Planet',
                'language' => 'en',
                'position' => 2,
                'content_shoert' => 'Lingkungan sangat erat kaitannya dengan aspek kehidupan dan manusia, seperti air, dan udara. PT. Bima Sakti Bahari berkomitmen untuk meningkatkan kesehatan planet dengan aktivitas-aktivitas yang mendukung pelestarian, perlindungan lingkungan dan sumber daya alam guna menjaga kesehatan, kenyamanan dan ketersediaan sumberdaya alam untuk anak cucu di masa depan',
                'flag_publish' => 'Y',
            ],
            [
                'title' => 'Profit',
                'language' => 'en',
                'position' => 3,
                'content_shoert' => 'Kami tidak hanya mengejar keuntungan. tetapi reputasi yang layak dibanggakan bangsa dan negara',
                'flag_publish' => 'Y',
            ],
        ];

        foreach ($setDefData as $key => $arr) { Sustainability::create($arr); }
    }
}
