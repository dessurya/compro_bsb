<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class TrialController extends Controller
{
    public function index()
    {
        return response()->json(['response' => true, 'trial-data' => [
            'mahasiswa' => [
                'nama' => 'ADAM SURYA DES',
                'nim' => 11211016,
                'kelas' => '11.8G.01'
            ],
            'jadwal' => [
                [
                    'mata-kuliah' => 'TRO',
                    'hari' => 'senin',
                    'jam' => [
                        'mulai' => '19:30 WIB',
                        'selesai' => '21:30 WIB',
                    ]
                ],
                [
                    'mata-kuliah' => 'AE',
                    'hari' => 'rabu',
                    'jam' => [
                        'mulai' => '19:30 WIB',
                        'selesai' => '21:30 WIB',
                    ]
                ],
                [
                    'mata-kuliah' => 'TWS',
                    'hari' => 'kamis',
                    'jam' => [
                        'mulai' => '19:30 WIB',
                        'selesai' => '21:30 WIB',
                    ]
                ]
            ]
        ]]);
    }

    public function callData(Request $http_req)
    {
        $product = Product::select(*);
        if (isset($http_req->id) and !empty($http_req->id)) {
            $product->where('id',$http_req->id);
        }
        $product = $product->get();
        return response()->json(['response'=>true,'data'=>$product]);
    }
}
