<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class Controller extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function login()
    {
        return view('task1');
    }

    public function task1()
    {
        return view('task1');
    }

    public function submit(Request $request)
    {
        if($request['nama'] === null || $request['jumlah'] === null){
            return redirect('/')->with(['warning' => 'Nama dan Jumlah tidak boleh kosong!']);
        }

        $URL = 'http://localhost:8080/engine-rest/process-definition/key/process_reimburse_wisnu/start';

        $data = [
            'nama' => [
                'value' => $request['nama'],
                'type' => 'String'
            ],
            'jumlah' => [
                'value' => $request['jumlah'],
                'type' => 'String'
            ],
            'keterangan' => [
                'value' => $request['keterangan'],
                'type' => 'String'
            ]
        ];

        $BUSINESS_KEY = "{$request['nama']}_business";

        $laporan = json_encode(array('variables' => $data, 'businessKey' => $BUSINESS_KEY));

        $curl = curl_init($URL);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $laporan);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);

        return redirect('task2')->with(['success' => 'Berhasil!']);
    }

    public function task2()
    {
        $TASK_ENDPOINT = "http://localhost:8080/engine-rest/task/?processDefinitionKey=process_reimburse_wisnu";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $TASK_ENDPOINT);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $data = [
            'results' => json_decode($result, true)
        ];
        
        return view('task2', $data);
    }

    public function detail($id)
    {
        $URL = "http://localhost:8080/engine-rest/task/$id/variables";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $URL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);
        
        $data = [
            'id' => $id,
            'nama' => $result['nama']['value'],
            'jumlah' => $result['jumlah']['value'],
            'keterangan' => $result['keterangan']['value']
        ];

        return view('detail', $data);
    }

    public function approve(Request $request)
    {
        $id = $request['id'];
        $approved = $request['approve'] === "true" ? true : false;
        $URL = "http://localhost:8080/engine-rest/task/$id/submit-form";

        $data = [
            'isApproved' => [
                'value' => $approved
            ]
        ];

        $laporan = json_encode(array('variables' => $data));

        $curl = curl_init($URL);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $laporan);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);

        return redirect('/task2')->with(['success' => 'Berhasil!']);
    }

    public function bukti($id)
    {
        $URL = "http://localhost:8080/engine-rest/task/$id/variables";
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $URL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);
        
        $data = [
            'id' => $id,
            'nama' => $result['nama']['value'],
            'jumlah' => $result['jumlah']['value'],
            'keterangan' => $result['keterangan']['value']
        ];

        return view('bukti', $data);
    }

    public function sendBukti(Request $request)
    {   
        // SEND GAMBAR
        $request->validate([
            'bukti' => 'required',
        ]);

        // encode base64
        if ($request->hasFile('bukti')) {
            if($request->file('bukti')->isValid()) {
                try {
                    $file = $request->file('bukti');
                    $image = base64_encode(file_get_contents($file));
                    echo $image;
                } catch (FileNotFoundException $e) {
                    echo $e;
                }
            }
        }
        
        // SEND EMAIL
        $id = $request['id'];
        $URL = "http://localhost:8080/engine-rest/task/$id/submit-form";

        $data = [
            'bukti' => [
                'value' => $image
            ]
        ];

        $laporan = json_encode(array('variables' => $data));

        $curl = curl_init($URL);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $laporan);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);

        return redirect('task2')->with(['success' => 'Berhasil !']);
    }
}
