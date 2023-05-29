<?php
/*    require_once 'auth.php';

    if (!checkAuth()) exit;
*/
//header('content-type: application/json');
//"content-type: application/octet-stream"
geolocalization();

function geolocalization() {
    $query = urlencode($_GET["q"]);
    $url = 'https://foreca-weather.p.rapidapi.com/location/search/'.$query.'?lang=en';
    $headers = array("X-RapidAPI-Key: 2e1f89de2amshd40f38c269b9279p1d2f5ajsnab2978928214",
                        "X-RapidAPI-Host: foreca-weather.p.rapidapi.com");
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $res=curl_exec($curl);
    curl_close($curl);
    echo $res;
}

/*<?php
    require_once 'auth.php';

    if (!checkAuth()) exit;



geolocalization();

function geolocalization() {
    $curl = curl_init();
    //$query = urlencode($_GET["q"]);
    $url = 'https://foreca-weather.p.rapidapi.com/location/search/Catania?lang=en';
    $headers = array("content-type: application/octet-stream",
                        "X-RapidAPI-Key: 2e1f89de2amshd40f38c269b9279p1d2f5ajsnab2978928214",
                        "X-RapidAPI-Host: foreca-weather.p.rapidapi.com");
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $res=curl_exec($curl);
    curl_close($curl);
    echo $res;
}


?>*/

?>

