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
        $check = dhl($randomAWB,$cookies);
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
    $headers[] = 'Cookie: bm_sz=2504CC51136F14A11A479880B3EA4D3D~YAAQpDLdFw+/9XJ4AQAAu2JoqQtmklyP8I0WSxqYKKNjAZd+jVwOwYWlfl+PO0LKrAvF5e7+sTIhSTRCTy/FTjOc3cuC8xYX2TUGfTVNs1Hfl1F79F36sseluH00G1nJ/YMDJi0wNpQz9g2KxW/+TNTD9hsT+bgXJMBDHh8e6/OkQI5nKM0Htv4brpVX4eT6vRfo/uM+GtJJdw76bH9HiKhS1aoEjCcy00FgQE5yH+pNZRQxZ6SBxLa9wEN7gBl88ot8NUSARt321ZTs616xWrjSkn6o4o6ikmjq; ak_bmsc=F9A0E269BF5E2CC9BC2F079598C3CA7717DD32A4F72B000085E76C6074D42B76~pljRgMqPLWwH2g6KHq03REJC027aFTTfVoGd3V2cdAixvLCF4UbSBGUjWTxwcOAIOhfQNcU+uDRb+eRkae4ya2d7B5AWZPrEKWfBgjfOA17zvSxJdAio80mKxMzLWwTbXdldYLIrQ2jCK/MAFn/S6XD3Hrk3pl0hyjONMGkAXEr+0BCN3JgqvoZ/637NMOiDs2sr12g/haiOP646MeyWZmJgamVAvNFNrGUS211x3HeP3DdwVN8a5iXOlMwnhCegEe; TS016f3c0b=01914b743d25d1698b01fd4becf600a38746f13a17d31a4f1b8b072040685199ea629e5d52996222ba2cb7189b99d8cf0499bd43db; bm_sv=CDB1F6827B484BE5360D69DCD928498F~ews+sqcrtYcqC/oyt5b9oGToERVufhKWaJjK0hgfVOkkndyjim8TLtfgM5/4SVDsGIsEmBeKzHzCns1VwM6QZRXWKPLwQ61GiPrDI6nvQqT83bou0ZUmldCpWke9DIaJXT0d+axyt6lYKIHRe737Yw==; _abck=CF6E9E0CA3BA4B271353C183D69658A5~-1~YAAQpDLdF2/B9XJ4AQAAO+loqQVWN98K/VqPFxFfKPlQgJypwd0RmBC70z+2kNg3UQ/a3vz3GUMswj2egdunQNH1kYIkjbypFTInjBSSGKLvmNs8tfO0BA1kl8L9SzQs8E55WLimKxyJYKC/WBXQLKgkQmFlel+wUUcPpG8GMCsyU2PnbUg2ioZ6XkwBhCRBOvVVckQHoQ3Xl7PymYARGOjdnG71vt0fbog1VcVffWqLX308vxtlK+uJ4dvHVuhXE+dxcnRlYIHOSd9Dyf0l62BqDo/YZt0Qp44uY6MvhRt/wUL/ILxng8RkbmJFsL5rT3A55W+D/SeY1RdinVXE02GQvns0dZ/FS2LUWHMmvO4f6zB8cUdKzcGc/8fOuRe0Sux1lSoGVGHbz0+IEFc3neSHb+z4cPjxF4Vi+vsP~-1~-1~-1; RT="z=1&dm=www.dhl.com&si=5b0cb51b-a547-4312-9487-a8b5a0aa57d7&ss=kn6luyfh&sl=9&tt=kh&obo=8&rl=1"; dhl_cookie_consent=accepted'; 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    

    
    $result = curl_exec($ch);
    if (curl_errno($ch)) { 
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    
    return $result;
}


?>
