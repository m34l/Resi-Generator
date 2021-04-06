<?php
/**
 * CREATE : M34L@Ismail Muhammad Zeindy
 * GANTI TULISAN SEMOGA MATI MENDADAK LO AJG
 * Special Thanks To : Setya Mickala as SHARE AIRDROP
 */
awal:
echo "MADE BY M34L@ISMAILMUHAMMADZEINDY".PHP_EOL." Pake resi2.php kalo mau cookies lebih lama dipake, ganti manual";

echo "Berapa Banyak? ";
$count = trim(fgets(STDIN));

$i = 0;
$j = 0;

$getcookies = Curi('https://www.dhl.com/en/express/tracking.html?AWB=9613888281&brand=DHL', false, false, false, false, true);
preg_match_all('%set-cookie: (.*?);%', $getcookies[0], $d);$cookies = '';
for($o = 0; $o < count($d[0]); $o++)$cookies.= $d[1][$o].";";

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
    $headers[] = 'Cookie: '.$cookies; 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    

    
    $result = curl_exec($ch);
    if (curl_errno($ch)) { 
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    
    return $result;
}

function Curi($url, $fields=false, $cookie=false, $httpheader=false, $proxy=false, $encoding=false, $timeout=false, $useragent=false)
{ 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    if($useragent !== false)
    {
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    }
    if($fields !== false)
    { 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    }
    if($encoding !== false)
    { 
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    }
    if($cookie !== false)
    { 
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    }
    if($httpheader !== false)
    { 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
    }
    if($proxy !== false)
    { 
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
    }
    if($timeout !== false)
    { 
      // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
      // curl_setopt($ch, CURLOPT_TIMEOUT, 6); //timeout in seconds     
    }
    $response = curl_exec($ch);
    $header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
    $body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
    $code=curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array($header, $body, $code);
}

?>
