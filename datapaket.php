<?php
$ekspedisi = $_POST["ekspedisi"];
$distrik_terpilih = $_POST["distrik"];
$total_berat = $_POST["berat"];

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "origin=501&destination=" . $distrik_terpilih . "&weight=" . $total_berat . "&courier=" . $ekspedisi,
    CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: MASUKKAN_API_KEYMU"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    // echo $response;
    // echo $ekspedisi;
    // echo $distrik_terpilih;
    // echo $total_berat;

    $array_response = json_decode($response, TRUE);
    $paket = $array_response["rajaongkir"]["results"]["0"]["costs"];

    // echo "<pre>";
    // print_r($paket);
    // echo "</pre>";

    echo '<option value="">-- Pilih Paket --</option>';

    foreach ($paket as $key => $tiap_paket) {
        echo '<option 
        paket="' . $tiap_paket["service"] . '"
        ongkir="' . $tiap_paket["cost"]["0"]["value"] . '"
        etd="' . $tiap_paket["cost"]["0"]["etd"] . '">';
        echo $tiap_paket["service"] . " / Rp. ";
        echo number_format($tiap_paket["cost"]["0"]["value"]) . " (";
        echo $tiap_paket["cost"]["0"]["etd"] . ")";
        echo '</option>';
    }
}
