<?php
    /*require_once 'auth.php';

    if (!checkAuth()) exit;
*/
//header('content-type: application/json');

resturants();

function resturants() {
    $curl = curl_init();
    $query_lat = urlencode($_POST["lat"]);
    $query_lon = urlencode($_POST["lon"]);
    if(isset($_POST["food"])){
        $query_food = urlencode($_POST["food"]);
    
        $url = 'https://local-business-data.p.rapidapi.com/search-nearby?query='.$query_food.'&lat='.$query_lat.'&lng='.$query_lon.'&limit=21';
        $headers = array("X-RapidAPI-Key: aa82f36674msh1e969e45068cdb7p140966jsn1271f5bf6aa1",
                            "X-RapidAPI-Host: local-business-data.p.rapidapi.com");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $res=curl_exec($curl);
        curl_close($curl);
        echo $res;
        return;  
    } else {
        $url = 'https://local-business-data.p.rapidapi.com/search-nearby?query=resturant&lat='.$query_lat.'&lng='.$query_lon.'&limit=21';
        $headers = array("X-RapidAPI-Key: aa82f36674msh1e969e45068cdb7p140966jsn1271f5bf6aa1",
                            "X-RapidAPI-Host: local-business-data.p.rapidapi.com");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $res=curl_exec($curl);
        curl_close($curl);
        echo $res;
        return;

    }
}

/*<?php
    require_once 'auth.php';

    if (!checkAuth()) exit;



resturants();

function resturants() {
    $curl = curl_init();
    //$query_lat = urlencode($_POST["lat"]);
    //$query_lon = urlencode($_POST["lon"]);
    if(isset($_POST["food"])){
        //$query_food = urlencode($_POST["food"]);
    
        $url = 'https://local-business-data.p.rapidapi.com/search-nearby?query=pizza&lat=37.4922&lng=15.0704&limit=21';
        $headers = array("content-type: 'application/octet-stream'",
                            "X-RapidAPI-Key: 17bb8b1c1emshfc217b2044f9cdap18c887jsn339a5e6fa6ac",
                            "X-RapidAPI-Host: local-business-data.p.rapidapi.com");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $res=curl_exec($curl);
        curl_close($curl);
        echo $res;
        return;  
    } else {
        $url = 'https://local-business-data.p.rapidapi.com/search-nearby?query=resturant&lat=37.4922&lng=15.0704&limit=21';
        $headers = array("content-type: 'application/octet-stream'",
                            "X-RapidAPI-Key: 17bb8b1c1emshfc217b2044f9cdap18c887jsn339a5e6fa6ac",
                            "X-RapidAPI-Host: local-business-data.p.rapidapi.com");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $res=curl_exec($curl);
        curl_close($curl);
        echo $res;
        return;

    }
}


?>*/

?>