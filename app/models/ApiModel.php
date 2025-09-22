<?php
namespace App\Models;

class ApiModel {
    public function getLiturgia() {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://liturgia.up.railway.app/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Accept: */*",
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return ['error' => "cURL Error: $err"];
        }

        $data = json_decode($response, true);
        return $data ?: ['error' => 'Resposta inválida da API'];
    }
}
