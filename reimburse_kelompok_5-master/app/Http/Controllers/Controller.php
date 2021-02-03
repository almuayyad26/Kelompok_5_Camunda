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
        $URL = 'http://sistemis.cloud.javan.co.id/engine-rest/process-definition/key/process_reimburse_wisnu/start';

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

        return $result;
    }

    public function task2()
    {
        $TASK_ENDPOINT = 'http://sistemis.cloud.javan.co.id/engine-rest/task';

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

    public function task2submit()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://sistemis.cloud.javan.co.id/engine-rest/process-instance?processDefinitionKey=process_reimburse_wisnu&businessKey=myBusinessKeyDamar');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result, true);

        return $result;
    }

    public function approve(Request $request)
    {
        $id = $request['id'];
        $approved = $request['approve'] === "true" ? true : false;
        $URL = "http://sistemis.cloud.javan.co.id/engine-rest/task/$id/submit-form";

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

        return redirect('/task2')->with(['success' => 'hasil perhitungan: '.$result]);;
    }
}
