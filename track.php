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

if (!empty($count)) {

    while($i<=$count){
        $randomAWB = rand(1000000000,9999999999);
        $check = dhl($randomAWB);
        $json_check = json_decode($check,true);
        //print_r($json_check);

        foreach ($json_check as $key => $code){
            if ($key =="results") {
                foreach ($code as $kode){
                    $status = $kode['delivery']['status'];
                    $awb = $kode['id'];
                    $desc = $kode['description'];
                    $origin = $kode['origin']['value'];
                    $destination = $kode['destination']['value'];
                    //$str = "$key : $status : $awb";

                    echo "\033[32m$key: $status : $awb : $destination : $desc \033[0m\n";
                    
                    file_put_contents('resi.txt',"$key : $status : $awb : $origin - $destination : $desc".PHP_EOL,FILE_APPEND);
    
                }
            } else {
                echo "\033[31m$key : INVALID AWB\033[0m\n";

            }
        }

        $i++;
    }

} else {
    echo "\033[31m KETIK JUMLAHNYA GOBLOK \033[0m\n";
}



function dhl($awb){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://www.dhl.com/shipmentTracking?AWB='.$awb.'&countryCode=g0&languageCode=en&_=1617645656661');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    
    $headers = array();
    $headers[] = 'Authority: www.dhl.com';
    $headers[] = 'Sec-Ch-Ua: \"Google Chrome\";v=\"89\", \"Chromium\";v=\"89\", \";Not A Brand\";v=\"99\"';
    $headers[] = 'Accept: image/avif,image/webp,image/apng,image/svg+xml,image/*,*/*;q=0.8';
    $headers[] = 'X-Requested-With: XMLHttpRequest';
    $headers[] = 'Sec-Ch-Ua-Mobile: ?0';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36';
    $headers[] = 'Sec-Fetch-Site: same-origin';
    $headers[] = 'Sec-Fetch-Mode: no-cors';
    $headers[] = 'Sec-Fetch-Dest: image';
    $headers[] = 'Referer: https://www.dhl.com/etc/designs/dhl/docroot/tracking/less/tracking.css';
    $headers[] = 'Accept-Language: id,en-US;q=0.9,en;q=0.8,und;q=0.7';
    $headers[] = 'Cookie: dhl_cookie_consent=accepted; RT=\"z=1&dm=www.dhl.com&si=5b0cb51b-a547-4312-9487-a8b5a0aa57d7&ss=kn5ndb6g&sl=0&tt=0&rl=1\"; ak_bmsc=0B63876E2AEE24118B3639D07D20D92C17DD32A4F72B000002C46C607616A061~plKSPUIPTlQlkFo9v2eD/KdBgRlfX9ioNm0cBnx/jslwgCZqOsglMMW5WZQmmLGWxyDKTP9mGHaMeTDRwyVbCQZ0mwDq+okjDn8iyQ7PjEBPhVXhOkQXVwPhIZUbaNH/IzvmLAus+CCZXDHsY9iD5qLqnG2bqTa4ulGFLb9CJzTjjS9R849DCmEEMtA+NpwM3agVqPZ+mYEoZkpKRg1fDXBIT/MY59PhTu5t4POmCPEVA=; bm_sz=7A3D1BB27F0A74CA69294F805BC6EE14~YAAQpDLdF8UY9HJ4AQAAbqvdqAss3MF66GRqJSYiC51Qc2uFVsW1k/VyyQcRAeztwm2HgaQbsmxfzVAlXeXXFqTyz5pLxvyc86BOG7XVIVYmhmzeli3moStnN7oBHM7UMxDhQ9S2wWkTwkKHMKcAjJdFNxjGaLAohE97J04yUQuF9LODuZojkSVXgXfDtQe5pchhtB63jUK7a1dfYgaknp7BvuRHK7oSn0vjRd6V2S/o1IfnazsZ4eEmu9n3A8rwcj/pfSqbYUHzv7PWWKRJz07PmJq7FV7ql2cj; TS016f3c0b=01914b743d87c934525fb5aa2205c520639c305a60729ec357df535baad2e3e7781b008fbb520f9a8f2599c16b4fa28e59885db288; bm_sv=9376C8AFC135E7910970BDAEE9B8BDD9~ews+sqcrtYcqC/oyt5b9oPTdBY44L1+eObI74qYhXh+mXtLsyvk9gmFHBXtISy8Z9bAr/VRQf1ioEYlyWGWF3rbBFbOHuiznGF4zNDP2jc9FCvLIGU7ZRdbNPgXIXgEo5oHeHd79nXxnkIXK+zkVqQ==; _abck=338B8666E40B7AA06B848984A1F967A8~-1~YAAQpDLdF9MY9HJ4AQAAccDdqAU1XZevoYDJANPeWkNBbY3XwyGUReeT8X0ETjFpVN+sxPyu77WJ/XY7Iac29p1aCxacWLEpuIaphDS2dpa/LUO3SqJJS2YMN/wD7dMbvvLj2/cJRtuzloKMpdY/9vQhA2Z+JzrEs7iQ9VAGhkVYYeLqFNYeCOKosiEOvP1SsSYZJPqdU/lovnL67pk4WqPC4mH440gecdawDeh6vWBseRBULSfl/3N0/uwD0luvrS49uHvJxydr5wqY0zDZLAENIs0sUEK4PrV85jWHcbtIAm+5ySpQPv+d81kSJQ06y7eEDLC0XBjIAzr+ugK8w98Tg5q53xQkBd+OxUoe3bd+FhmBgHQrjduLG/T1Poq08FUpIjQgGoaX2IsEXUuqgRhjgSlW3YxbK2/jkqtk~-1~-1~-1';
    $headers[] = 'If-None-Match: \"160734-ce-59e8670cf66c0\"';
    $headers[] = 'If-Modified-Since: Fri, 14 Feb 2020 10:12:19 GMT';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) { 
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    
    return $result;
}

?>