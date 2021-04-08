<?php
/**
 * CREATE : M34L@Ismail Muhammad Zeindy
 * GANTI TULISAN SEMOGA MATI MENDADAK LO AJG
 * Special Thanks To : Setya Mickala as SHARE AIRDROP
 */
awal:
echo "MADE BY M34L@ISMAILMUHAMMADZEINDY".PHP_EOL;
echo "1. DHL ".PHP_EOL."2. Aliex".PHP_EOL."3. USPS".PHP_EOL.": ";
$choose = trim(fgets(STDIN));
echo "Berapa Banyak? ";
$count = trim(fgets(STDIN));

$i = 1;
$j = 1;



if (!empty($count)) {

    while(true){
        if ($choose == '1') {
            $randomAWB = ''.random(10,0).'';
        
        $check = Curi('https://www.dhl.com/shipmentTracking?AWB='.$randomAWB.'&countryCode=g0&languageCode=en&_=1617645656661');
        $json_check = json_decode($check[1],true);
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
        } else if ($choose == '2') {
            $string = array('LP','UB');
            $k = array_rand($string);
			$v = $string[$k];

            $randomAWB1 = 'LP19'.random(7,0).'SG';
            $check = Curi('https://global.cainiao.com/detail.htm?mailNoList='.$randomAWB1.'&spm=a3708.7860688.0.d01');
            $getdata =html_entity_decode(getStr($check[1],'<textarea style="display: none;" id="waybill_list_val_box">','</textarea>'));
           
            if (strpos($getdata, 'latestTrackingInfo')) {
                $datanya = json_decode($getdata);
                $latest = $datanya->data[0]->latestTrackingInfo->desc;
                $dest = $datanya->data[0]->destCountry;
                $org = $datanya->data[0]->originCountry;
                $time = $datanya->data[0]->latestTrackingInfo->time;
                $awb = $latestinfo = $datanya->data[0]->mailNo;

                    if ($i > $count) {
                        die("Done!");
                    } else {

                        echo "\033[32m$i.  VALID | $awb : $latest  : $org : $dest : $time \033[0m\n";
                        @ob_flush();
                         flush();
                        file_put_contents('resi.txt',"VALID | $awb : $latest  : $org : $dest : $time".PHP_EOL,FILE_APPEND);
                        $i++;

                    }

            } else {
                echo "\033[31m$j. $randomAWB1 : INVALID AWB\033[0m\n";
                @ob_flush();
                flush();
                $j++;

            }
        } else if($choose == '3'){
            $randomAWB2 = 'LX'.random(9,0).'US';
            $check = Curi('https://tools.usps.com/go/TrackConfirmAction?tRef=fullpage&tLc=2&text28777=&tLabels='.$randomAWB2.'%2C&tABt=false');

            if (!strpos($check[1],'Label Created, not yet in system')){
                if ($i > $count) {
                    die("Done!");
                } else {
                echo "\033[32m$i.  VALID | $randomAWB2 : USPS \033[0m\n";
                @ob_flush();
                flush();
                file_put_contents('resiusps.txt',"VALID | $randomAWB2 : USPS".PHP_EOL,FILE_APPEND);
                $i++;
                }
            } else {
                echo "\033[31m$j. $randomAWB2 : INVALID AWB\033[0m\n"; 
                @ob_flush();
                flush();
                $j++;
            }

          
        } else {
            die("Pilih yang bener tolol");
        }
    }

} else {
    echo "\033[31m KETIK JUMLAHNYA GOBLOK \033[0m\n";
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
function getStr($string,$start,$end){
        $str = explode($start,$string);
        $str = explode($end,$str[1]);
        return $str[0];
    } 
function random($length,$a) 
	{
		$str = "";
		if ($a == 0) {
			$characters = array_merge(range('0','9'));
		}elseif ($a == 1) {
			$characters = array_merge(range('0','9'),range('a','z'));
		}
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}


?>
