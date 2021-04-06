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
    $headers[] = 'Cookie: AWBS=3874133863; BRAND=Express%20Services; ak_bmsc=03F783297B4788165B8402F8F142741817DD32A4F72B0000BBE46C60043F9046~plJ9RQdRSWmBjKdsdJsHlM+qZwfUMcoohZs1GSm4hkvuCngEOeesQ9FEPapDqGJKms0TQa5SDEGumafBZmYPt3vqIKyjP3a87nAXkTzTVvkoDWvBvax9zKlvPellriRuRsy69kTxImoXGU0eUAltG4Sn38pd29w0AmNVGu4hcxeFQ0c8Hmq0gkRUB6t6EJh5MwhVT5iOTVIci/HN5YEEyKbDK+WJh5M0Os306/V5L46BY=; bm_sz=34AA4B9E148E597788CBF69DC7335045~YAAQpDLdF/J89XJ4AQAAnnxdqQthEM9in9Z4oe9yMFAcLP0jvuCQ5wjWfH0lL4tr5jomyu9cOikTgpUe0B6zuAa7U2EYY3jlJDizMjiSilYNSp6Oe/7Nd0kGkE0UPn631rKZL56X4CjSsr7G/jTsx3MI3jtDtt0pvPRaNssnUGMnU/0ozzarGMdz3QBl15qo/flOyKoIsq0oQ3InuAP1twyStP89gqd83v20bs3y1GA1NEztRlClOlfmlFP7OaZKL03FoJ5GmM6HIlCMHVcBqW2da3ygOijKpvbd; dhl_cookie_consent=shown; bm_sv=E1B7822C24533E6E933072F8D6E73133~ews+sqcrtYcqC/oyt5b9oDbXiPjXPIVS/AVI54G58GqcQIupb4U7UB9z7Yjzl5UkBZ2HjtKN5ZiGqmX5xc+oqI+ikbzmOmowjfPQAWKTsx4y57o8i4STiAgTPTv0Khl4JNUXe5ii0kar6X1Im8WX2w==; _abck=858FA80BD4F81E4E26077CBFAE255907~-1~YAAQpDLdF2d+9XJ4AQAA19BdqQWqeJlsTmf0H9i+zl1hqSRktZRDa6wdf+B7HdPRuvXa3RSRa/Wf1Lrud7JM+hNDb4nEZ66Y3t5K1GIsmacT+PQoMxNTutmHe0rHPfNX6ZdLjnE7ZuR4GYKO0yh4uCvfcgWWancBhGnkmo/uPXPJK/8XYF9OqQBCDAQg2BoWkF8kobbgD9KvgEfUbgRrO7ys4H/98psJVURKItT6mxuTN8Q3jOhTuPODOjpW75TcEvjO+Or5KXVWaDHvfQyJxykenSONFxibsfsbe1MG4+Q0we7ngcfz7wRbyhFvI1V4EPzOYvg9oGIMZZ7vjpU8C6fTO4fT00S5cPUVLKDw9pbLYlbsqnaU8s2T/9YToYTSlM2FNFk2GYgfqmgn0QoyJ5ru4pGas12sP+3siQf0~-1~-1~-1; RT="z=1&dm=www.dhl.com&si=5b0cb51b-a547-4312-9487-a8b5a0aa57d7&ss=kn6luyfh&sl=7&tt=kh&obo=6&rl=1&ld=a19d&r=40b5rslx&ul=a19f"'; //PASTE DISINI
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    

    
    $result = curl_exec($ch);
    if (curl_errno($ch)) { 
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    
    return $result;
}

?>
