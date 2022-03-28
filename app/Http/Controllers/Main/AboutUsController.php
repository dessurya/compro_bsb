<?php

namespace App\Http\Controllers\MAin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AboutUsController extends Controller
{
    protected $lang;

    function __construct()
    {
        $this->lang = App::currentLocale();
    }

    public function index()
    {
        $lang = $this->lang;
        $history = [
            'id' => '<p>Diawali tahun 1986, perusahaan mendapatkan surat ijin usaha budi daya mutiara dari Direktur Jendral Perikanan No.IK.120/03.5757/86, tanggal 29 September 1986 dan Surat Persetujuan Tetap pmdn No.269/I/PMDN/1986 tanggal 24 November 1986.</p><p>Tahun 1992, perusahaan mendapatkan Ijin Usaha Tetap dari Ketua BKPM No.30/T/PERTANIAN/1992 tanggal 25 januari 1992, di mana dari Desember 1988, perusahaan berproduksi komersial untuk daerah di Teluk Sape, Kabupaten Bima, NTB.</p><p>Tahun 2020, PT. Bima Sakti Bahari mendapatkan rekomendasi untuk perpanjangan usahanya di bisnis perdagangan dan perikanan untuk perairan teluk sape dan perairan Tengge dan perairan Radu, Kabupaten Bima, Provinsi NTB.</p><p>Tahun 2021, PT. Bima Sakti Bahari mengambil alih saham asing di PT. Tirtamas Mutiara sehingga mengubah status perusahaan PMA menjadii PMDN untuk lokasi perairan Teluk Pangkajarat, Kabupaten Bima, NTB.</p>',
            'en' => '<p>In 1986, the company obtained a pearl cultivation business license from the Director-General of Fisheries No.IK.120/03.5757/86, dated September 29, 1986, and a Permanent Approval Letter of PMDN No.269/I/PMDN/1986 dated November 24, 1986.</p><p>In 1992, the company obtained a Permanent Business License from the Chairman of BKPM No.30/T/PERTANIAN/1992 dated January 25, 1992, wherefrom December 1988, the company was producing commercially for the area in Sape Bay, Bima Regency, NTB.</p><p>In 2020, PT. Bima Sakti Bahari received recommendations for the extension of its business in trade and fisheries business for the waters of Sape bay and Tengge waters and waters of Radu, Bima Regency, NTB Province</p><p>In 2021, PT. Bima Sakti Bahari took over foreign shares in PT. Tirtamas Mutiara thus changed the status of the PMA company to become PMDN for the location of the waters of Pangkajarat Bay, Bima Regency, NTB.</p>'
        ];
        $visi = [
            'id' => '<p>Turut serta menjadikan indonesia sebagai kekuatan dunia di bidang perikanan dan kelautan.</p>',
            'en' => '<p>Participate in making Indonesia a world power in the field of fisheries and marine.</p>'
        ];
        $misi = [
            'id' => [
                'Berkontribusi sebagai salah satu perusahaan swasta nasional terkemuka di bidang perikanan dan kelautan.',
                'Meningkatkan kemampuan sumber daya manusia Indonesia sebagai penggerak perekonomian bangsa.',
                'Mengembangkan teknologi sumber daya kelautan Indonesia menjadi kebanggaan nasional yang dihargai dunia.',
                'Menjalankan model usaha yang berkelanjutan dengan memperhatikan kondisi lingkungan hidup sekitar dan kesejahteraan sumber daya manusia perusahaan.',
            ],
            'en' => [
                "Contribute as one of the leading national private companies in the field of fisheries and marine.",
                "Improve Indonesia's human resources capability as a driver of the nation's economy.",
                "Developing Indonesia's marine resources technology becomes a national pride that is appreciated by the world.",
                "Run a sustainable business model about the environmental conditions and the welfare of the company's human resources.",
            ],
        ];
        $title_page = [
            'id' => 'Tentang Kami',
            'en' => 'About Us'
        ];
        $history = $history[$lang];
        $visi = $visi[$lang];
        $misi = $misi[$lang];
        $title_page = $title_page[$lang];

        $management = [
            [
                'name' => 'Hashim S Djojohadikusumo',
                'title' => [
                    'id' => 'Komisaris',
                    'en' => 'Komisaris',
                ],
                'quotes' => [
                    'id' => 'Jadilah pemimpin yang mengayomi masyarakat bawah dan atas',
                    'ed' => 'Be the leader who protects society down and down.',
                ],
                'msg' => [
                    'id' => '<P>Lulusan Claremont University, California, Jurusan Ilmu Politik dan Ekonomi. Pernah menjadi Analis Keuangan di bank investasi Perancis, dan pernah menjabat Direktur di Indo Consult. Dan melalui perusahaannya, PT. Tirtamas Majutama mengakuisisi PT Semen Cibinong.</P><P>Dengan pengalaman tersebut tidak diragukan lagi dapat membawa arah perusahaan lebih berkualitas, dan terpecaya.</P>',
                    'en' => '<p>Graduated from Claremont University, California, Majoring in Political Science and Economics. He has been a Financial Analyst at a French investment bank and has served as a Director at Indo Consult. Through his company, PT. Tirtamas Majutama acquired PT Semen Cibinong.</p><p>Such experience can undoubtedly bring the direction of the company more qualified and trusted.</p>'
                ]
            ],
            [
                'name' => 'R Saraswati D Djojohadikusumo',
                'title' => [
                    'id' => 'Direktur Utama',
                    'en' => 'Direktur Utama',
                ],
                'quotes' => [ 'id' => null, 'ed' => null, ],
                'msg' => [
                    'id' => '<p>Rahayu Saraswati D. Djojohadikusumo lahir pada 27 Januari 1986 di Jakarta, Indonesia. Mendapatkan gelar sarjana Bachelor of Sciences in Liberal Studies melalui Purdue University Global, Indiana, Amerika Serikat. Sejak tahun 2009, ibu dari 2 anak laki-laki ini telah menjadi seorang aktivis anti perdagangan orang. Di tahun 2012, ia akhirnya mendirikan sebuah yayasan yang fokus di bidang tersebut bernama Yayasan Parinama Astha (ParTha) dengan harapan yayasan ini akan menjadi yang terdepan dalam melawan perdagangan orang di Indonesia. Hal itulah yang membawanya ke dunia politik praktis. Sara terpilih sebagai Anggota DPR RI dari daerah pemilihan Jawa Tengah IV. Selama di DPR, ia dipercaya oleh fraksinya untuk mewakili suara rakyat dan partainya di Komisi VIII yang menjadi mitra Kementerian Sosial, Agama, Pemberdayaan Perempuan dan Perlindungan Anak, dan Badan Nasional Penanggulangan Bencana.</p><p>Di tahun 2016, ia berhasil memperjuangkan dan ikut serta mengesahkan UU Penyandang Disabilitas. Sara juga berhasil mengusung dan memperjuangkan Revisi UU Perkawinan dalam upaya mengilegalkan perkawinan anak di Indonesia. Sampai akhir masa pengabdiannya di DPR, ia terus memperjuangkan RUU Penghapusan Kekerasan Seksual demi pemenuhan hak, perlindungan, dan pendampingan para korban kekerasan seksual.</p><p>Di akhir 2018, ia menginisiasi Jaringan Nasional Anti Tindak Pidana Perdagangan Orang (JarNas Anti TPPO). Setelah menyelesaikan tugasnya sebagai wakil rakyat, kini Sara membantu pengembangan usaha keluarganya, Arsari Group, yang terus bergerak memberikan solusi permasalahan iklim di bidang agroforestry dan energi terbarukan/berkelanjutan. Hal ini selaras dengan keprihatinannya mengenai lingkungan hidup dan krisis iklim. Namun dia juga akan fokus pada sektor wisata berkelanjutan dan inovasi teknologi berkelanjutan.</p><p>Di tahun 2020, Sara dipilih menjadi Ketua Delegasi RI untuk ajang KTT Y20 2020 di Arab Saudi. Sekarang, ia juga berperan sebagai Wakil Ketua Umum  di DPP GERINDRA (Bidang Pemuda, Perempuan dan Anak), Ketua Bidang Pengembangan Perenan Perempuan PP TIDAR (Tunas Indonesia Raya), Anggota Dewan Kepengurusan Indonesian Youth Diplomacy (IYD), Dewan Pakar Kaukus Perempuan Parlemen RI (KPP RI), Dewan Pembina Yayasan Peduli Down Syndrome Indonesia (YAPDSI), dan Ketua JarNas Anti TPPO.</p>',
                    'en' => "<p>Rahayu Saraswati D. Djojohadikusumo was born on January 27, 1986 in Jakarta, Indonesia. Earn a bachelor's degree in Liberal Studies through Purdue University Global, Indiana, UNITED STATES. Since 2009, the mother-of-two has been an anti-trafficking activist. In 2012, he finally established a foundation focused on that field called Parinama Astha Foundation (ParTha) in the hope that this foundation will be at the forefront of fighting people trafficking in Indonesia. That's what brought him into practical politics. Sara was elected as a Member of the House of Representatives from the Central Java IV constituency. During her time in the House of Representatives, she was trusted by her faction to represent the voice of the people and her party in Commission VIII which became a partner of the Ministry of Social Affairs, Religion, Women Empowerment, and Child Protection, and the National Disaster Management Agency.</p><p>In 2016, he successfully fought for and participated in passing the Law on Persons with Disabilities. Sara also successfully promoted and championed the Revision of the Marriage Law to legalize child marriage in Indonesia. Until the end of his term in the House of Representatives, he continued to fight for the Bill on the Elimination of Sexual Violence for the fulfillment of the rights, protection, and assistance of victims of sexual violence.</p><p>At the end of 2018, he initiated the National Anti-Trafficking In Persons Network (JarNas Anti TPPO). After completing her duties as a representative of the people, Sara is now helping the development of her family's business, Arsari Group, which continues to move to provide solutions to climate problems in the field of agroforestry and renewable/sustainable energy. This is in line with his concerns about the environment and the climate crisis. But he will also focus on the sustainable tourism sector and sustainable technological innovation.</p><p>In 2020, Sara was chosen as the Head of The Indonesian Delegation for the Y20 2020 Summit in Saudi Arabia. Now, she also serves as Deputy Chairman of DPP GERINDRA (Youth, Women, and Children), Chairperson of Women's Development of PP TIDAR (Tunas Indonesia Raya), Member of the Indonesian Youth Diplomacy (IYD) Management Board, Expert Council of the Indonesian Parliament Women's Caucus (KPP RI), Board of Trustees of Yayasan Peduli Down Syndrome Indonesia (YAPDSI), and Chairman of JarNas Anti TPPO.</p>",
                ]
            ],
            [
                'name' => 'Bahtera Putra',
                'title' => [
                    'id' => 'Direktur Operasional',
                    'en' => 'Direktur Operasional',
                ],
                'quotes' => [ 'id' => null, 'ed' => null, ],
                'msg' => [
                    'id' => "<p>Lulus dari pendidikan di salah satu Akademi dan Perguruan Tinggi Swasta di Jakarta pada jurusan akuntansi (S1). Memulai karir sebagai staff akuntasi dan kepala urusan Cost Accounting di salah satu perusahaan BUMD dan PMA di Jakarta.</p><p>Bergabung dengan group perusahaan yang dipimpin oleh Bapak Hashim Djojohadkusumo yang saat ini bernama Arsari Group sejak bulan Februari tahun 1988 dan ditempatkan sebagai Manager Finance and Accounting di beberapa perusahaan dalam group yang bergerak dalam bidang Factory (Blending Chemical), Agency, Trading, Komunikasi, Production House, hingga sejak tahun 2015 dipercaya sebagai salah satu DIreksi di perusahaan yang bergerak dalam budidaya mutiara, PT. Bima Sakti Bahari.</p>",
                    'en' => "<p>Graduated from education at one of the private academies and universities in Jakarta majoring in accounting (S1). Started his career as an accounting staff and head of Cost Accounting at a BUMD and PMA company in Jakarta.</p><p>Joined a group of companies led by Mr. Hashim Djojohadkusumo who is currently called Arsari Group since February 1988 and was placed as Manager of Finance and Accounting in several companies in the group which are engaged in Factory (Blending Chemical), Agency, Trading, Communication, Production House, until 2015 he was trusted as one of the Directors in a company engaged in pearl cultivation, PT. Bima Sakti Bahari</p>",
                ]
            ],
            [
                'name' => 'Daniel F. Poluan',
                'title' => [
                    'id' => 'Direktur Admin & Keuangan',
                    'en' => 'Direktur Admin & Keuangan',
                ],
                'quotes' => [ 'id' => null, 'ed' => null, ],
                'msg' => [
                    'id' => "<p>Menanjak karier dari bawah sebagai Asisten Pribadi AsMen III bidang Program di Kementerian Riset, kemudian Kemenristek. Dalam perjalanan bekerja sambil belajar, menjadi Office Manager di PT Indoconsult (Konsultan Ekonomi Pertama di Indonesia). Mendapat kesempatan belajar ke California, USA, mendapat gelar MBA in Accounting, spesialisasi di bidang 'Taxation and Financial Management.' Pernah bekerja sebagai Chief Accountant di Multinational Company; 'Head of Treasury and Accounting, PERTAMINA Representive Office for Europe/based in London.' Kembali ke Indonesia, langsung bekerja 'full time' sebagai 'Personal Assistant-Finance, Chairman and CEO Tirtamas Group', kemudian dipercaya menjadi Direktur dan Komisaris di beberapa perusahaan, di bawah naungan ARSARI Group. Disamping di bidang sekuler/bisnis, Daniel sejak 'teenager' aktif di Pelayanan Rohani, memuliakan TUHAN senantiasa, sambil belajar mendalami Teologi. Daniel Poluan juga ikut di berbagai pelayanan sosial keluarga pak Hashim S. Djojohadikusumo/'Philantropist' (Pendiri ARSARI Group) hingga saat ini.</p>",
                    'en' => "<p>Climbed his career from the bottom as Personal Assistant to AsMen III in the Program field at the Ministry of Research, then the Ministry of Research and Technology. On the way to work while studying, he became an Office Manager at PT Indoconsult (The First Economic Consultant in Indonesia). Had the opportunity to study in California, USA, received an MBA in Accounting, specializing in 'Taxation and Financial Management.' Previously worked as Chief Accountant in a Multinational Company; 'Head of Treasury and Accounting, PERTAMINA Representative Office for Europe/based in London.' Returned to Indonesia, immediately worked 'full time' as 'Personal Assistant-Finance, Chairman and CEO of Tirtamas Group', then trusted to become Director and Commissioner in several companies, under the auspices of ARSARI Group. Apart from being in the secular/business field, Daniel has been active since a 'teenager' in the Spiritual Ministry, glorifying God always, while studying deeply in Theology. Daniel Poluan has also participated in various family social services for Mr. Hashim S. Djojohadikusumo/'Philantropist' (Founder of ARSARI Group) until now.</p>",
                ]
            ],
        ];

        $css = [
        ];
        $js = [
        ];
        return view('main.page.about-us', compact('history','visi','misi','management','lang','css','js','title_page'));
    }
}
