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



function dhl($awb){
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
    //ganti cookiesnya disini, bisa pake f12 /dll
    $headers[] = 'Cookie: dhl_cookie_consent=accepted; bm_sz=7A3D1BB27F0A74CA69294F805BC6EE14~YAAQpDLdF8UY9HJ4AQAAbqvdqAss3MF66GRqJSYiC51Qc2uFVsW1k/VyyQcRAeztwm2HgaQbsmxfzVAlXeXXFqTyz5pLxvyc86BOG7XVIVYmhmzeli3moStnN7oBHM7UMxDhQ9S2wWkTwkKHMKcAjJdFNxjGaLAohE97J04yUQuF9LODuZojkSVXgXfDtQe5pchhtB63jUK7a1dfYgaknp7BvuRHK7oSn0vjRd6V2S/o1IfnazsZ4eEmu9n3A8rwcj/pfSqbYUHzv7PWWKRJz07PmJq7FV7ql2cj; ak_bmsc=9AE381C24BC32225A0A70294998B025417DD32A4F72B000035E36C60A48AC71C~plVUSns9TxZzgHvkUdMm40tvB98/wC2SwN9rulmphYPtHdKzL0KLMVN2DyXQXnYZhVKW7UGu/bPtrLRS8QpKslNp5blOPfo20s03uu7d43Y4C28MyRUt6/SYzFSUEqlh0zsWH0JWWmwssL7FfC90N2iy6FefI0MQS6LkrUD8S6aD13QvD0APdvZyVbBxQNmOYAqVgzAXmdxk9SvV+iTQRImNfYQvvjJqYeoZXhImly4rguzkjlhVIYlLDD+RYFGesU; TS016f3c0b=01914b743d395db6b512a35381f23824ed3f7eba3df31c92a9e3e061d755f50a634e5d3d7a7eb7fa24f19084cf816cb51652e1b089; _abck=338B8666E40B7AA06B848984A1F967A8~-1~YAAQpDLdFzhm9XJ4AQAA16BXqQUP8jDH/7cBJjbu+AzopHWuNtHM0hQoC+GVHvx9G8dxWLivPjhKKmidzS6WMRT5bU56V4/XSL0VpuTeeMmNUjfKWg17X3k38AEyfEcKTsRuCx9YQhOs+4tJWrpu5Xibj/7qlSi+fKd5860NyW4SU7MrMc14r/JdT8EnojwfdRYsaoENy4kvUEi9bER1kMFwZNgv5LJzTS/Kag8or83HDGcv/GKjGrFdlNN0aBUgLZ38AnS0nx2HhtAGf1GaNB8zuAXkGzI5r1ePhnlBaMa/ebYnyvZ7ey447w9fc0a71Q8jp61G83rcprzblLhwDVeZDS730wAk5PzWQpusJs4RAqK0iK6duGGFB1/1zx8bJqgg51ALh5lMXrgaBdBDnVEz6OiStYu9TIwa8Dn/~-1~-1~-1; bm_sv=CC3B4CEB32594C59F5316786F7828F52~ews+sqcrtYcqC/oyt5b9oBQiE7brwmXOIpQMm3yJVtFpzxjg6MkRbcQOlnekF4b9n0ijsPkUeqbFDXlegddSTT+PJuZszPnkxF59qaR6uNGGubGcNvTJPfz5I0bDk4d2OZjyBvLsipQYjIy2LESS7g==; RT=\"z=1&dm=www.dhl.com&si=5b0cb51b-a547-4312-9487-a8b5a0aa57d7&ss=kn6luyfh&sl=2&tt=kh&obo=1&rl=1\"';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    

    
    $result = curl_exec($ch);
    if (curl_errno($ch)) { 
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    
    return $result;
}

?>
