<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageConfigAboutUsController extends Controller
{
    protected $getFileDir = 'config_json/about-us.json';

    public function index()
    {
        $file = $this->getFileDir;
        $arrConf = [
            'intruduction' => [
                'id' => [
                    'title' => 'Sejarah',
                    'content' => '<p>PT BIMA SAKTI BAHARI (PT. BSB) adalah nama perusahaan dibawah naungan ARSARI GROUP yang mengganti nama PT BIMA SAKTI MUTIARA (PT. BSM) yang telah selama 35 tahun menjalankan bisnisnya yaitu usaha budi daya Mutiara. Perubahan nama di atas bertujuan untuk menampilkan arah bisnis perusahaan yang lebih luas, tidak hanya akan memproduksi mutiara melalui budi daya kerang mutiaranya tetapi juga semua potensi bahari atau hasil laut seperti ikan Laut, Lobster, Rumput Laut, Teripang, dan lain sebagainya.</p><p>Diawali tahun 1986, perusahaan mendapatkan surat ijin usaha budi daya mutiara dari Direktur Jendral Perikanan No.IK.120/03.5757/86, tanggal 29 September 1986 dan Surat Persetujuan Tetap pmdn No.269/I/PMDN/1986 tanggal 24 November 1986.</p><p>Tahun 1992, perusahaan mendapatkan Ijin Usaha Tetap dari Ketua BKPM No.30/T/PERTANIAN/1992 tanggal 25 januari 1992, di mana dari Desember 1988, perusahaan berproduksi komersial untuk daerah di Teluk Sape, Kabupaten Bima, NTB.</p><p>Tahun 2020, PT. Bima Sakti Bahari mendapatkan rekomendasi untuk perpanjangan usahanya di bisnis perdagangan dan perikanan untuk perairan teluk sape dan perairan Tengge dan perairan Radu, Kabupaten Bima, Provinsi NTB.</p><p>Tahun 2021, PT. Bima Sakti Bahari mengambil alih saham asing di PT. Tirtamas Mutiara sehingga mengubah status perusahaan PMA menjadii PMDN untuk lokasi perairan Teluk Pangkajarat, Kabupaten Bima, NTB.</p>'
                ],
                'en' => [
                    'title' => 'History',
                    'content' => "<p>PT BIMA SAKTI BAHARI (PT. BSB) is the name of the company under the auspices of ARSARI GROUP which changed the name of PT BIMA SAKTI MUTIARA (PT. BSM) which has been running its business for 35 years is a Pearl cultivation business. The name change above aims to display the company's broader business direction, will not only produce pearls through the cultivation of its pearl shells but also all the potential of marine or marine products such as sea fish, lobster, seaweed, sea cucumber, etc.</p><p>In 1986, the company obtained a pearl cultivation business license from the Director-General of Fisheries No.IK.120/03.5757/86, dated September 29, 1986, and a Permanent Approval Letter of PMDN No.269/I/PMDN/1986 dated November 24, 1986.</p><p>In 1992, the company obtained a Permanent Business License from the Chairman of BKPM No.30/T/PERTANIAN/1992 dated January 25, 1992, wherefrom December 1988, the company was producing commercially for the area in Sape Bay, Bima Regency, NTB.</p><p>In 2020, PT. Bima Sakti Bahari received recommendations for the extension of its business in trade and fisheries business for the waters of Sape bay and Tengge waters and waters of Radu, Bima Regency, NTB Province</p><p>In 2021, PT. Bima Sakti Bahari took over foreign shares in PT. Tirtamas Mutiara thus changed the status of the PMA company to become PMDN for the location of the waters of Pangkajarat Bay, Bima Regency, NTB.</p>"
                ],
                'img' => null,
            ],
            'visi' => [
                'id' => 'Turut serta menjadikan indonesia sebagai kekuatan dunia di bidang perikanan dan kelautan.',
                'en' => 'Participate in making Indonesia a world power in the field of fisheries and marine.',
            ],
            'misi' => [
                'id' => [
                    10 => "Berkontribusi sebagai salah satu perusahaan swasta nasional terkemuka di bidang perikanan dan kelautan.",
                    20 => "Meningkatkan kemampuan sumber daya manusia Indonesia sebagai penggerak perekonomian bangsa.",
                    30 => "Mengembangkan teknologi sumber daya kelautan Indonesia menjadi kebanggaan nasional yang dihargai dunia.",
                    40 => "Menjalankan model usaha yang berkelanjutan dengan memperhatikan kondisi lingkungan hidup sekitar dan kesejahteraan sumber daya manusia perusahaan.",
                ],
                'en' => [
                    10 => "Contribute as one of the leading national private companies in the field of fisheries and marine.",
                    20 => "Improve Indonesia's human resources capability as a driver of the nation's economy.",
                    30 => "Developing Indonesia's marine resources technology becomes a national pride that is appreciated by the world.",
                    40 => "Run a sustainable business model about the environmental conditions and the welfare of the company's human resources.",
                ]
            ],
            'founder' => [
                'id' => [
                    'title' => 'TEMUI PENDIRI KAMI',
                ],
                'en' => [
                    'title' => 'MEET OUR FOUNDER',
                ],
            ],
            'management' => [
                'id' => [
                    'title' => 'TEMUI MANAJEMEN KAMI',
                ],
                'en' => [
                    'title' => 'MEET OUR MANAGEMENT',
                ],
            ],
            'staff' => [
                'id' => [
                    'title' => 'TEMUI PEKERJA KAMI',
                ],
                'en' => [
                    'title' => 'MEET OUR STAFF',
                ],
            ],
        ];
        if (file_exists($file)){ $arrConf = json_decode(file_get_contents($file),true); }
        else{file_put_contents($file, json_encode($arrConf));}
        return view('cms.page.page-config-about-us', compact( 'arrConf' ));
    }

    public function store(Request $httpRequest)
    {
        $res = ['response' => true];
        $file = $this->getFileDir;
        $arrConf = json_decode(file_get_contents($file),true);
        if ($httpRequest->type == 'string') {
            $new_arr = $this->storeString($arrConf,$httpRequest->input());
        }else if ($httpRequest->type == 'img') {
            $new_arr = $this->storeImg($arrConf,$httpRequest->input());
        }
        unlink($file);
        file_put_contents($file, json_encode($new_arr));
        return response()->json($res);
    }

    private function storeString($arrConf,$input)
    {
        $arrConf['founder']['id']['title'] = $input['founder_id_title'];
        $arrConf['founder']['en']['title'] = $input['founder_en_title'];
        $arrConf['management']['id']['title'] = $input['management_id_title'];
        $arrConf['management']['en']['title'] = $input['management_en_title'];
        $arrConf['staff']['id']['title'] = $input['staff_id_title'];
        $arrConf['staff']['en']['title'] = $input['staff_en_title'];
        $arrConf['intruduction']['id']['title'] = $input['intruduction_id_title'];
        $arrConf['intruduction']['id']['content'] = $input['intruduction_id_content'];
        $arrConf['intruduction']['en']['title'] = $input['intruduction_en_title'];
        $arrConf['intruduction']['en']['content'] = $input['intruduction_en_content'];
        $arrConf['visi']['id'] = $input['visi_id'];
        $arrConf['visi']['en'] = $input['visi_en'];
        $arrConf['misi']['id'] = json_decode($input['misi_id'],true);
        $arrConf['misi']['en'] = json_decode($input['misi_en'],true);
        return $arrConf;
    }

    private function storeImg($arrConf,$input)
    {
        if (isset($arrConf[$input['for']][$input['key']]) and !empty($arrConf[$input['for']][$input['key']])) { unlink($arrConf[$input['for']][$input['key']]); }
        $dir_estimate = 'config_img';
        $dir_file = '';
        foreach (explode('/',$dir_estimate) as $item) {
            $dir_file .= $item.'/';
            if (!file_exists($dir_file)){ mkdir($dir_file, 0777); }
        }
        $path_file = $dir_file.'about_'.$input['for'].'_'.$input['key'].'_'.$input['img_name'];
        try {
            file_put_contents($path_file, base64_decode($input['img_encode']));
        } catch (Exception $e) {
            $msg = $e->getMessage();
            return response()->json([
                'response' => false,
                'http_req' => $msg
            ]);
        }
        $arrConf[$input['for']][$input['key']] = $path_file;
        return $arrConf;
    }
}
