<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function index()
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

        $BUSINESS_KEY = "{$request['nama']}Business";

        $laporan = json_encode(array('variables' => $data, 'businessKey' => $BUSINESS_KEY));

        $curl = curl_init($URL);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $laporan);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);

        return redirect('/')->with(['success' => 'Berhasil!']);
    }

    public function task2()
    {
        $TASK_ENDPOINT = "http://localhost:8080/engine-rest/task/?processDefinitionKey=process_reimburse_wisnu&name=Review";

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

    public function review($id)
    {
        $TASK_ENDPOINT = "http://localhost:8080/engine-rest/task/$id/variables";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $TASK_ENDPOINT);
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

        return view('review', $data);
    }

    public function receive()
    {
        $TASK_ENDPOINT = "http://localhost:8080/engine-rest/task/?processDefinitionKey=process_reimburse_wisnu&name=Input+Bukti+Transfer";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $TASK_ENDPOINT);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $data = [
            'results' => json_decode($result, true)
        ];
        
        return view('receive', $data);
    }

    public function reject()
    {
        $TASK_ENDPOINT = "http://localhost:8080/engine-rest/task/?processDefinitionKey=process_reimburse_wisnu&name=Input+Alasan+Penolakan";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $TASK_ENDPOINT);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $data = [
            'results' => json_decode($result, true)
        ];

        return view('reject', $data);
    }

    public function sendReceive($id)
    {
        $URL = "http://localhost:8080/engine-rest/task/$id/submit-form";

        $curl = curl_init($URL);
        curl_setopt($curl, CURLOPT_POSTFIELDS, '');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);

        return redirect('/receive')->with(['success' => 'Berhasil!']);
    }

    public function sendReject($id)
    {
        $URL = "http://localhost:8080/engine-rest/task/$id/submit-form";

        $curl = curl_init($URL);
        curl_setopt($curl, CURLOPT_POSTFIELDS, '');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);

        return redirect('/reject')->with(['success' => 'Berhasil!']);
    }
}
