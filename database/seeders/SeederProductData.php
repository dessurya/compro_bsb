<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class SeederProductData extends Seeder
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
                'title' => 'Mutiara',
                'language' => 'id',
                'position' => 1,
                'content_shoert' => 'Budidaya Mutiara PT. Bima Sakti Bahari merupakan satu-satunya budidaya mutiara terbesar',
                'content' => '<p>Budidaya Mutiara PT. Bima Sakti Bahari merupakan satu-satunya budidaya mutiara terbesar dan satu-satunya orientasi ekspor yang berada di Kota Bima Nusa Tenggara Barat hingga menguasai pasar dunia saat ini. Keberadaan usaha budi daya mutiara ini secara langsung dapat membuka lapangan pekerjaan bagi masyarakat setempat dan disekitarnya.</p><p>Usaha budidaya mutiara yang berorientasi ekspor, menggunakan mesin-mesin dengan teknologi terkini dalam menjalankan produksi, dengan tujuan agar mutiara yang dihasilkan merupakan mutiara yang berkualitas, sehingga usaha yang dijalankan dapat semakin maju dan berkembang. Dengan di ciptakannya alat-alat teknologi baru yang didatangkan dari luar maupun dalam negeri, secara langsung dapat menunjang dalam melakukan aktivitas/kegiatan usaha budi daya mutiara sehari-hari.</p>',
                'slug' => 'mutiara',
                'flag_publish' => 'Y',
            ],
            [
                'title' => 'Pearl',
                'language' => 'en',
                'position' => 1,
                'content_shoert' => 'Pearl Cultivation PT. Bima Sakti Bahari is the only cultivation of the largest pearl and the only export orientation located in the City of Bima West Nusa Tenggara to dominate the world market today',
                'content' => '<p>Pearl Cultivation PT. Bima Sakti Bahari is the only cultivation of the largest pearl and the only export orientation located in the City of Bima West Nusa Tenggara to dominate the world market today. The existence of this pearl cultivation business can directly open jobs for the local community and around it.</p><p>Export-oriented pearl cultivation business, using machines with the latest technology in carrying out production, with the aim that the pearl produced is quality, so that the business that is run can be further advanced and developed. With the creation of new technological tools brought from outside and within the country, it can directly support in carrying out daily pearl cultivation activities.</p>',
                'slug' => 'pearl',
                'flag_publish' => 'Y',
            ],
            [
                'title' => 'Lobster',
                'language' => 'id',
                'position' => 2,
                'content_shoert' => 'Kegiatan budi daya Lobster di lokasi PT. Bima Sakti Bahari diterapkan secara mandiri',
                'content' => '<p>Kegiatan budi daya Lobster di lokasi PT. Bima Sakti Bahari diterapkan secara mandiri maupun dengan skema social entreprise yang melibatkan dan memberdayakan masyarakat nelayan dalam penangkapan, penampungan, pemeliharaan, dan pembesaran benih lobster. Menciptakan dan menjaga tata niaga usaha benih maupun lobster yang berkelanjutan dan kondusif sehingga semua tingkat niaga bisa saling mendukung dan menguntungkan untuk jangka panjang.</p>',
                'slug' => 'lobster',
                'flag_publish' => 'Y',
            ],
            [
                'title' => 'Lobsters',
                'language' => 'en',
                'position' => 2,
                'content_shoert' => 'Lobster cultivation activities at the location of PT. Bima Sakti Bahari is applied independently as well as with a social enterprise scheme',
                'content' => '<p>Lobster cultivation activities at the location of PT. Bima Sakti Bahari is applied independently as well as with a social enterprise scheme that involves and empowers fishing communities in the capture, shelter, maintenance, and enlargement of lobster seeds. Create and maintain a sustainable and conducive seed and lobster business so that all levels of commerce can support each other and benefit each other for the long term.</p>',
                'slug' => 'lobsters',
                'flag_publish' => 'Y',
            ],
            [
                'title' => 'Rumput laut',
                'language' => 'id',
                'position' => 3,
                'content_shoert' => 'Salah satu komoditi perairan yang cukup memiliki potensial di Indonesia',
                'content' => '<p>Salah satu komoditi perairan yang cukup memiliki potensial di Indonesia adalah rumput laut. Lokasi PT. Bima Sakti Bahari yang cocok untuk budi daya rumput laut menggunakan bibit rumput laut dengan kualitas yang terjamin, tahan terhadap serangan hama dan penyakit serta memiliki volume produksi yang lebih bagus untuk mendukung tercapainya peningkatan produksi rumput laut secara berkelanjutan. Metode membudidayakan rumput laut di perairan laut dengan 3 (tiga) model yaitu rakit apung, lepas dasar, dan metode long line.</p>',
                'slug' => 'rumput_laut',
                'flag_publish' => 'Y',
            ],
            [
                'title' => 'Seaweed',
                'language' => 'en',
                'position' => 3,
                'content_shoert' => 'One of the water commodities that have enough potential in Indonesia is seaweed',
                'content' => '<p>One of the water commodities that have enough potential in Indonesia is seaweed. Location of PT. Milky Way Bahari which is suitable for seaweed cultivation uses seaweed seeds with guaranteed quality, is resistant to pest and disease attacks, and has a better production volume to support the achievement of sustainable seaweed production. Method of cultivating seaweed in sea waters with 3 (three) models, namely floating rafts, off the base, and longline methods.</p>',
                'slug' => 'seaweed',
                'flag_publish' => 'Y',
            ],
            [
                'title' => 'Tripang',
                'language' => 'id',
                'position' => 4,
                'content_shoert' => '>Teripang dikenal sebagai salah satu komoditas laut yang banyak dicari karena memiliki khasiat yang dipercaya dapat memelihara kesehatan',
                'content' => '<p>Teripang dikenal sebagai salah satu komoditas laut yang banyak dicari karena memiliki khasiat yang dipercaya dapat memelihara kesehatan. Lokasi PT Bima Sakti Bahari memiliki Karakteristik teluk dengan tingkat sedimentasi yang cukup tinggi pada perairan dangkal < 3m. kualitas air dan karakteristik yang baik memiliki keunggulan untuk budidata teripang.</p>',
                'slug' => 'tripang',
                'flag_publish' => 'Y',
            ],
            [
                'title' => 'Tripangs',
                'language' => 'en',
                'position' => 4,
                'content_shoert' => '>Teripang dikenal sebagai salah satu komoditas laut yang banyak dicari karena memiliki khasiat yang dipercaya dapat memelihara kesehatan',
                'content' => '<p>Teripang dikenal sebagai salah satu komoditas laut yang banyak dicari karena memiliki khasiat yang dipercaya dapat memelihara kesehatan. Lokasi PT Bima Sakti Bahari memiliki Karakteristik teluk dengan tingkat sedimentasi yang cukup tinggi pada perairan dangkal < 3m. kualitas air dan karakteristik yang baik memiliki keunggulan untuk budidata teripang.</p>',
                'slug' => 'tripangs',
                'flag_publish' => 'Y',
            ],
        ];

        foreach ($setDefData as $key => $arr) { Product::create($arr); }
    }
}
