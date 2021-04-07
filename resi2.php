<?php
/**
 * CREATE : M34L@Ismail Muhammad Zeindy
 * GANTI TULISAN SEMOGA MATI MENDADAK LO AJG
 * Special Thanks To : Setya Mickala as SHARE AIRDROP
 */
awal:
echo "Berapa Banyak? ";
$count = trim(fgets(STDIN));

$i = 0;
$j = 0;


if (!empty($count)) {

    while(true){
        $randomAWB = rand(1000000000,9999999999);
        $check = dhl($randomAWB);
        $json_check = json_decode($check,true);
        //print_r($json_check);

        foreach ($json_check as $key => $code){
            if ($key =="results") {
                foreach ($code as $kode){
                    if ($i >= $count) {
                        die("Done!");
                    } else {
                        $status = $kode['delivery']['status'];
                        $awb = $kode['id'];
                        $desc = $kode['description'];
                        $origin = $kode['origin']['value'];
                        $destination = $kode['destination']['value'];
                        //$str = "$key : $status : $awb";
    
                        echo "\033[32m$i. $key: $status : $awb : $destination : $desc \033[0m\n";
                        
                        file_put_contents('resi.txt',"$key : $status : $awb : $origin - $destination : $desc".PHP_EOL,FILE_APPEND);
                        $i++;

                    }
                }
            } else {
                echo "\033[31m$j. $key : INVALID AWB\033[0m\n";
                $j++;

            }
        }

        
    }

} else {
    echo "\033[31m KETIK JUMLAHNYA GOBLOK \033[0m\n";
}



function dhl($awb,$cookies){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://www.dhl.com/shipmentTracking?AWB='.$awb.'&countryCode=g0&languageCode=en&_=1617645656661');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    $headers = array();
    $headers[] = 'Authority: www.dhl.com';
    $headers[] = 'Sec-Ch-Ua: \"Google Chrome\";v=\"89\", \"Chromium\";v=\"89\", \";Not A Brand\";v=\"99\"';
    $headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
    $headers[] = 'X-Requested-With: XMLHttpRequest';
    $headers[] = 'Sec-Ch-Ua-Mobile: ?0';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36';
    $headers[] = 'Sec-Fetch-Site: same-origin';
    $headers[] = 'Sec-Fetch-Mode: cors';
    $headers[] = 'Sec-Fetch-Dest: empty';
    $headers[] = 'Referer: https://www.dhl.com/en/express/tracking.html?AWB=3874133863&brand=DHL';
    $headers[] = 'Accept-Language: id,en-US;q=0.9,en;q=0.8,und;q=0.7';
  //GANTI COOKIES LO MANUAL DISINI
    $headers[] = 'Cookie: AWBS=5797030853; BRAND=Express%20Services; bm_sz=8F9FBE09E411B30EE358E031A6F1B244~YAAQpDLdF/Zk+HJ4AQAAxfXCqQsPuqR/bqhNRqc8KsPqGc7N4pWXbbKwyf2gLjkiQCMwZQAU9aR8wjpcamZpvls8skROF/XYJ/t5300xZq/EFV2C6t2xBMuLuiTcXMWflIX9VtY1uxyD/fYowdr9ZBYGR9szDtvIM/Q3cJFI9pk1LVS1vBu7qylby7CMEU5LBvioQkhwepNn7RGWfzZ8OHdhb6XbwL1VH1Rg+dOb8sAs3bp9ty2L/L+OofQRx4EmZH5sio9ZoKqvPy23RQ2EDnl7nsu89mKCTMWn; _abck=E11F4CDA3AE4A539178782B494D32B1F~-1~YAAQpDLdF/dk+HJ4AQAAxfXCqQVtD1nGNDaeSSEXQi91Necx7qveZo1olXmdBYu9BO5BFL7vg/LT7QeqM2YcMhQ6O3FtnD+M508OcdIS1AzZbVTQgkzpho0YkFyf4ae+7xm/Xq0j4R2t2YxoV2+E/Xd+DS3HchMNJps6NncdJKy8yNt5cOE0tVtpipy0rvkyq+l+XADKrYfKCGPWQ4yKt4Yzk60VLFfmzUL/J07nsmoSthpOFkDdsWprR1OYmYkVefNmqZWrRDwPYcVGN0hr1zJ4KphnzBBFPhRA/2KowNWSq4dIEEIA5oUxfBAKGlp0V1b2KO5orkRo7xqdnUxzfgL5QbKqLubjtS7a/jImS980RYNr3xtVezuFw3H4szUYVR8qBxDpci6+Xx31jo0dhA==~-1~-1~-1; ak_bmsc=61F5D46DA7FA29162B83780473599F1817DD32A4F72B0000B5FE6C600F7A387A~plzsHYYGMQCb0WDb+71JhXJA7krsRMwbl5+AbiLCMpl2KFSE+7/pZeUrpXGEk/NkgQEyAF9NCt93irM3HZkxwDHrJYrI0yNfSSd8s51kUIGnvwEa7BC04AcqlpBMwe2iExZVArVTbfobnAaFDf4/GRQafM04wzTfaggT97FafOOayqgwWnkv/Xrr9En+7LXrEJw+HgUsMynZHKuqkiinMNApJLnoZEzfry3R8eeqQ5BTcCV6UuUSWKKa+h1k1V0bdIpwqD0p0mmCinCws3afk/u2kvEmjwUW/GYVOMuet7Qqh7kDFBHnjUTDLGeakeSxFpnPYNIuqSVw8u1cIT+CXx/A==; dhl_cookie_consent=shown; RT=\"z=1&dm=www.dhl.com&si=5b0cb51b-a547-4312-9487-a8b5a0aa57d7&ss=kn6luyfh&sl=c&tt=kh&obo=b&rl=1&ld=46x2n&r=2v4ejaep&ul=46x2n\"';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    

    
    $result = curl_exec($ch);
    if (curl_errno($ch)) { 
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    
    return $result;
}


?>
