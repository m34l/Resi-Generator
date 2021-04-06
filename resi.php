<?php
/**
 * CREATE : M34L@Ismail Muhammad Zeindy
 * GANTI TULISAN SEMOGA MATI MENDADAK LO AJG
 * Special Thanks To : Setya Mickala as SHARE AIRDROP
 */
awal:
echo "Mau Berapa Resi Valid? ";
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
                    if ($i > $count) {
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
    //ganti cookies lo disini
    $headers[] = 'Cookie: dhl_cookie_consent=accepted; bm_sz=7A3D1BB27F0A74CA69294F805BC6EE14~YAAQpDLdF8UY9HJ4AQAAbqvdqAss3MF66GRqJSYiC51Qc2uFVsW1k/VyyQcRAeztwm2HgaQbsmxfzVAlXeXXFqTyz5pLxvyc86BOG7XVIVYmhmzeli3moStnN7oBHM7UMxDhQ9S2wWkTwkKHMKcAjJdFNxjGaLAohE97J04yUQuF9LODuZojkSVXgXfDtQe5pchhtB63jUK7a1dfYgaknp7BvuRHK7oSn0vjRd6V2S/o1IfnazsZ4eEmu9n3A8rwcj/pfSqbYUHzv7PWWKRJz07PmJq7FV7ql2cj; TS016f3c0b=01914b743dc3f71ce88b8bfbf9736a515caa885f75fc780024914ffe1015568f0b1ab6a5fd8b445e7cd7eabab3ed7f9bea62a0ab3f; _abck=338B8666E40B7AA06B848984A1F967A8~-1~YAAQpDLdF7fp9HJ4AQAArgs7qQWKuCcb33ugNu8TKlH7/x6P53WGp4HS7rbVIQd54hwSLl9pWNMBkkWRoY/sMzxcLfD4Ic2SXCJOoeesi1Ez8ws6m3MWG1HrMmoVFEgUuIc9iGYRCY08Rl5maKWDWiRLrDw7WXryTghYGxFvQGpCfDCOCzaC3cnkhMHgu+RYZ69CrbXqCG11Ofh6+u0W6Cgx3zPyARIcWrB5++ly1RVS6fsR5bhhRc+C6XnAbOe6rnPmx4xTGa0UpjQZNY9vPw6yR6DL3XXSLQAnWFVJ16R/gA2AfsmSvgJpcKrAJRQKZvSdrccb3aYDoM8fTohXGQrL7qrJuIdYhhHk61Z/IXzt3hNZjVeFuBmytwO0L7L04NYlcYv2xsjTlqfaGbpTL+xVFqcsgQ9X68+8+QOt~-1~-1~-1; bm_sv=9376C8AFC135E7910970BDAEE9B8BDD9~ews+sqcrtYcqC/oyt5b9oPTdBY44L1+eObI74qYhXh+mXtLsyvk9gmFHBXtISy8Z9bAr/VRQf1ioEYlyWGWF3rbBFbOHuiznGF4zNDP2jc8nU4+8u7P7GOiMzB6vLRr0OLnL0bgap8bgAifCKw3E1w==; RT=\"z=1&dm=www.dhl.com&si=5b0cb51b-a547-4312-9487-a8b5a0aa57d7&ss=kn6kqvtz&sl=1&tt=1im&rl=1\"; bm_mi=2F950144BED534B773D196538787D94D~ZsmHUzQO0JdApMmC6/7c32l3eN8oLLR0oICgRpLxbg7rik4ocJN022ucKBUpZvyVh0bbsqlotRSbJR7K6xeqe6Z/vlGOlEzAPpSk8stEG+4RDG9Bo3p7xYXoyz6bFAxX0Zb/TkCqKanahkHrEIFBjw20a1kxVO9z0gWZ7duthYAqf29CQCWJEN90Mm0eh0kd3EycI8UgPrgy9Iw/8UVOynkxPCizLgkRBj3qAOuXcPGJ+Tcg/sagO548s4+88bc2yC+WZgUQhNmEZD6E7w++FIfPKF+cBwWWCF6oAZOd4uQ=; ak_bmsc=0B63876E2AEE24118B3639D07D20D92C17DD32A4F72B000002C46C607616A061~pl7gOx+0+0oX28SS3uQCgyJfrAabEYZZeut90YRhFkj5fEvaJrbT48elBiBGiSb+qyC4SZ7+Ut5nzH/FD5TsxjSgj2XSAdsbZvF05+RvhX5Pz4AV6xpb21U5bRXjDBj89qP++vjqFGr2zrD7O8goZYrtbdGG2U9vTzqNd5H4QVNFUvrQx0SpOQ/lpxaZDwUwx3eZzrtO2d65Gp6Hi+p5Xuk//ZkhcC8GyHf8QjDKMkrOm8gqeOufogNwnuJctlahPB';
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) { 
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    
    return $result;
}

?>
