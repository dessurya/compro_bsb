<?php

namespace App\Http\Controllers\MAin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Management;

class AboutUsController extends Controller
{
    public function index()
    {
        $lang = App::getLocale();
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

        $management = [];
        $getManagement = Management::where('flag_publish','Y')->orderBy('queues','ASC')->get();
        foreach ($getManagement as $idx => $data) {
            $set = [];
            $set['name'] = $data->name;
            $set['img'] = null;
            if (!empty($data->img)) {$set['img'] = url($data->img);}
            if ($lang == 'id') { $set['title'] = $data->job_title_id; }
            else { $set['title'] = $data->job_title_en; }
            if ($lang == 'id') { $set['quotes'] = $data->quotes_id; }
            else { $set['quotes'] = $data->quotes_en; }
            if ($lang == 'id') { $set['msg'] = $data->text_id; }
            else { $set['msg'] = $data->text_en; }
            $management[] = $set;
        }

        $css = [
        ];
        $js = [
        ];

        return view('main.page.about-us', compact('history','visi','misi','management','lang','css','js','title_page'));
    }
}
