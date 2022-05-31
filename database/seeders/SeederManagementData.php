<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Management;

class SeederManagementData extends Seeder
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
                'name' => 'Hashim S Djojohadikusumo',
                'job_title_en' => 'Komisaris',
                'job_title_id' => 'Komisaris',
                'queues' => 1,
                'quotes_en' => 'Be the leader who protects society down and down.',
                'quotes_id' => 'Jadilah pemimpin yang mengayomi masyarakat bawah dan atas',
                'text_en' => '<p>Graduated from Claremont University, California, Majoring in Political Science and Economics. He has been a Financial Analyst at a French investment bank and has served as a Director at Indo Consult. Through his company, PT. Tirtamas Majutama acquired PT Semen Cibinong.</p><p>Such experience can undoubtedly bring the direction of the company more qualified and trusted.</p>',
                'text_id' => '<p>Lulusan Claremont University, California, Jurusan Ilmu Politik dan Ekonomi. Pernah menjadi Analis Keuangan di bank investasi Perancis, dan pernah menjabat Direktur di Indo Consult. Dan melalui perusahaannya, PT. Tirtamas Majutama mengakuisisi PT Semen Cibinong.</p><p>Dengan pengalaman tersebut tidak diragukan lagi dapat membawa arah perusahaan lebih berkualitas, dan terpecaya.</p>',
                'flag_publish' => 'Y',
            ],
            [
                'name' => 'R Saraswati D Djojohadikusumo',
                'job_title_en' => 'Direktur Utama',
                'job_title_id' => 'Direktur Utama',
                'queues' => 2,
                'quotes_en' => null,
                'quotes_id' => null,
                'text_en' => "<p>Rahayu Saraswati D. Djojohadikusumo was born on January 27, 1986 in Jakarta, Indonesia. Earn a bachelor's degree in Liberal Studies through Purdue University Global, Indiana, UNITED STATES. Since 2009, the mother-of-two has been an anti-trafficking activist. In 2012, he finally established a foundation focused on that field called Parinama Astha Foundation (ParTha) in the hope that this foundation will be at the forefront of fighting people trafficking in Indonesia. That's what brought him into practical politics.</p>",
                'text_id' => '<p>Rahayu Saraswati D. Djojohadikusumo lahir pada 27 Januari 1986 di Jakarta, Indonesia. Mendapatkan gelar sarjana Bachelor of Sciences in Liberal Studies melalui Purdue University Global, Indiana, Amerika Serikat. Sejak tahun 2009, ibu dari 2 anak laki-laki ini telah menjadi seorang aktivis anti perdagangan orang. Di tahun 2012, ia akhirnya mendirikan sebuah yayasan yang fokus di bidang tersebut bernama Yayasan Parinama Astha (ParTha) dengan harapan yayasan ini akan menjadi yang terdepan dalam melawan perdagangan orang di Indonesia. Hal itulah yang membawanya ke dunia politik praktis.</p>',
                'flag_publish' => 'Y',
            ],
            [
                'name' => 'Bahtera Putra',
                'job_title_en' => 'Direktur Operasional',
                'job_title_id' => 'Direktur Operasional',
                'queues' => 3,
                'quotes_en' => null,
                'quotes_id' => null,
                'text_en' => '<p>Graduated from education at one of the private academies and universities in Jakarta majoring in accounting (S1). Started his career as an accounting staff and head of Cost Accounting at a BUMD and PMA company in Jakarta.</p><p>oined a group of companies led by Mr. Hashim Djojohadkusumo who is currently called Arsari Group since February 1988 and was placed as Manager of Finance and Accounting in several companies in the group which are engaged in Factory (Blending Chemical), Agency, Trading, Communication, Production House, until 2015 he was trusted as one of the Directors in a company engaged in pearl cultivation, PT. Bima Sakti Bahari</p>',
                'text_id' => '<p>Lulus dari pendidikan di salah satu Akademi dan Perguruan Tinggi Swasta di Jakarta pada jurusan akuntansi (S1). Memulai karir sebagai staff akuntasi dan kepala urusan Cost Accounting di salah satu perusahaan BUMD dan PMA di Jakarta.</p><p>Bergabung dengan group perusahaan yang dipimpin oleh Bapak Hashim Djojohadkusumo yang saat ini bernama Arsari Group sejak bulan Februari tahun 1988 dan ditempatkan sebagai Manager Finance and Accounting di beberapa perusahaan dalam group yang bergerak dalam bidang Factory (Blending Chemical), Agency, Trading, Komunikasi, Production House, hingga sejak tahun 2015 dipercaya sebagai salah satu DIreksi di perusahaan yang bergerak dalam budidaya mutiara, PT. Bima Sakti Bahari.</p>',
                'flag_publish' => 'Y',
            ],
            [
                'name' => 'Daniel F. Poluan',
                'job_title_en' => 'Direktur Admin & Keuangan',
                'job_title_id' => 'Direktur Admin & Keuangan',
                'queues' => 4,
                'quotes_en' => null,
                'quotes_id' => null,
                'text_en' => "<p>Climbed his career from the bottom as Personal Assistant to AsMen III in the Program field at the Ministry of Research, then the Ministry of Research and Technology. On the way to work while studying, he became an Office Manager at PT Indoconsult (The First Economic Consultant in Indonesia). Had the opportunity to study in California, USA, received an MBA in Accounting, specializing in 'Taxation and Financial Management.' Previously worked as Chief Accountant in a Multinational Company; 'Head of Treasury and Accounting, PERTAMINA Representative Office for Europe/based in London.' Returned to Indonesia, immediately worked 'full time' as 'Personal Assistant-Finance, Chairman and CEO of Tirtamas Group', then trusted to become Director and Commissioner in several companies, under the auspices of ARSARI Group. Apart from being in the secular/business field, Daniel has been active since a 'teenager' in the Spiritual Ministry, glorifying God always, while studying deeply in Theology. Daniel Poluan has also participated in various family social services for Mr. Hashim S. Djojohadikusumo/'Philantropist' (Founder of ARSARI Group) until now.</p>",
                'text_id' => "<p>Menanjak karier dari bawah sebagai Asisten Pribadi AsMen III bidang Program di Kementerian Riset, kemudian Kemenristek. Dalam perjalanan bekerja sambil belajar, menjadi Office Manager di PT Indoconsult (Konsultan Ekonomi Pertama di Indonesia). Mendapat kesempatan belajar ke California, USA, mendapat gelar MBA in Accounting, spesialisasi di bidang 'Taxation and Financial Management.' Pernah bekerja sebagai Chief Accountant di Multinational Company; 'Head of Treasury and Accounting, PERTAMINA Representive Office for Europe/based in London.' Kembali ke Indonesia, langsung bekerja 'full time' sebagai 'Personal Assistant-Finance, Chairman and CEO Tirtamas Group', kemudian dipercaya menjadi Direktur dan Komisaris di beberapa perusahaan, di bawah naungan ARSARI Group. Disamping di bidang sekuler/bisnis, Daniel sejak 'teenager' aktif di Pelayanan Rohani, memuliakan TUHAN senantiasa, sambil belajar mendalami Teologi. Daniel Poluan juga ikut di berbagai pelayanan sosial keluarga pak Hashim S. Djojohadikusumo/'Philantropist' (Pendiri ARSARI Group) hingga saat ini.</p>",
                'flag_publish' => 'Y',
            ],
        ];

        foreach ($setDefData as $key => $arr) { Management::create($arr); }
    }
}
