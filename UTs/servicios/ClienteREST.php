<?php
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://opendata.aemet.es/opendata/api/valores/climatologicos/inventarioestaciones/todasestaciones/?api_key=eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJhbmdlbGxvcGV6cGFsYWNpb3M2MUBnbWFpbC5jb20iLCJqdGkiOiJiODRkMzc4MS0zMjU0LTQzYzEtODg3Ni0wM2E1NTExYzFiMzEiLCJpc3MiOiJBRU1FVCIsImlhdCI6MTYxMTY1ODEwNCwidXNlcklkIjoiYjg0ZDM3ODEtMzI1NC00M2MxLTg4NzYtMDNhNTUxMWMxYjMxIiwicm9sZSI6IiJ9.dwvnFdJVsy4We48Hs_-sW221HZnrdAz_rxsIcTfWQeA",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
    ),
));

//Evitamos el protocolo SSL para no instalar certificados propios
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//Ejecutamos la petición al API
$response = curl_exec($curl);
$err = curl_error($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $obj=json_decode($response);
    var_dump($obj);
}
