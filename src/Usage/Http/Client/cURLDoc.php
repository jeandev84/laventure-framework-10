<?php
declare(strict_types=1);

// GET
$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$html = curl_exec($ch);
curl_close($ch);

echo $html;

// GET with params
$get = array(
    'name'  => 'Alex',
    'email' => 'mail@example.com'
);

$ch = curl_init('https://example.com?' . http_build_query($get));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$html = curl_exec($ch);
curl_close($ch);

echo $html;


// POST
$array = array(
    'login'    => 'admin',
    'password' => '1234'
);

$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array, '', '&'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$html = curl_exec($ch);
curl_close($ch);

echo $html;


// JSON via POST
$data = array(
    'name'  => 'Маффин',
    'price' => 100.0
);

$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$res = curl_exec($ch);
curl_close($ch);

$res = json_encode($res, JSON_UNESCAPED_UNICODE);
print_r($res);



// PUT
$data = array(
    'name'  => 'Маффин',
    'price' => 100.0
);

$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array, '', '&'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$html = curl_exec($ch);
curl_close($ch);

echo $html;


// DELETE
$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_exec($ch);
curl_close($ch);


// PROXY
$proxy = '165.22.115.179:8080';

$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_TIMEOUT, 400);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$html = curl_exec($ch);
curl_close($ch);



// UPLOAD FILE
$curl_file = curl_file_create(__DIR__ . '/image.png', 'image/png' , 'image.png');

$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('photo' => $curl_file));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$res = curl_exec($ch);
curl_close($ch);


$curl_file = curl_file_create(__DIR__ . '/image.png', 'image/png' , 'image.png');

$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('photo' => $curl_file));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$res = curl_exec($ch);
curl_close($ch);


// REST API (PUT UPLOAD)
$curl_file = curl_file_create(__DIR__ . '/image.png', 'image/png' , 'image.png');

$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('photo' => $curl_file));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$res = curl_exec($ch);
curl_close($ch);



// DOWNLOAD METHOD 1:
$file_name = __DIR__ . '/file.html';
$file = @fopen($file_name, 'w');

$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_FILE, $file);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_exec($ch);
curl_close($ch);

fclose($file);


// METHOD 2
$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$html = curl_exec($ch);
curl_close($ch);

file_put_contents(__DIR__ . '/file.html', $html);


// COOKIE
$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);

$html = curl_exec($ch);
curl_close($ch);



$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_COOKIE, 'PHPSESSID=61445603b6a0809b061080ed4bb93da3');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);

$html = curl_exec($ch);
curl_close($ch);



// UserAgent
$headers = array(
    'cache-control: max-age=0',
    'upgrade-insecure-requests: 1',
    'user-agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36',
    'sec-fetch-user: ?1',
    'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
    'x-compress: null',
    'sec-fetch-site: none',
    'sec-fetch-mode: navigate',
    'accept-encoding: deflate, br',
    'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
);

$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, true);
$html = curl_exec($ch);
curl_close($ch);

echo $html;



// BASIC AUTH
$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_USERPWD, 'login:password');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$html = curl_exec($ch);
curl_close($ch);

echo $html;



// OAUTH
$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: OAuth TOKEN'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$html = curl_exec($ch);
curl_close($ch);

echo $html;


// Response Code
$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo $http_code; // Выведет: 200



// Curl Errors
$ch = curl_init('https://example.com');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_exec($ch);
$res = curl_exec($ch);

var_dump($res); // false

if ($errno = curl_errno($ch)) {
    $message = curl_strerror($errno);
    echo "cURL error ({$errno}):\n {$message}"; // Выведет: cURL error (35): SSL connect error
}

curl_close($ch);



/**
 * A quick example of storing CURL cookies outside of a local cookie jar file.
 * Can be very useful for retaining API sessions between distributed applications.
**/

// Split out cookies from CURL response
function splitCookies($rawResponse, &$cookieData)
{
    // Separate header and body
    list($curlHeader, $curlBody) = preg_split("/\R\R/", $rawResponse, 2);

    // Split out data from Set-Cookie headers
    preg_match_all("/^Set-Cookie:\s+(.*);/mU", $curlHeader, $cookieMatchArray);
    $cookieData = implode(';', $cookieMatchArray[1]);

    return $curlBody;
}


// Example of getting a cookie
$curlObj = curl_init();
curl_setopt($curlObj, CURLOPT_HEADER, true);
curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curlObj, CURLOPT_URL, "http://127.0.0.1/SendMeSomeCookies");
$responseData = splitCookies(curl_exec($curlObj), $cookieData);
curl_close($curlObj);


// Example of using said cookie in another CURL session
$curlObj = curl_init();
curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curlObj, CURLOPT_COOKIE, $cookieData);
curl_setopt($curlObj, CURLOPT_URL, "http://127.0.0.1/CookiesRequired");
$responseData = curl_exec($curlObj);
curl_close($curlObj);

