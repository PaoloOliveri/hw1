<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    saved_resturants();

    function saved_resturants(){
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $userid = mysqli_real_escape_string($conn, $userid);

        $query = "SELECT * FROM resturants WHERE username = '$userid'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        
        $resturants_liked_array = array();
        while($resturant = mysqli_fetch_assoc($res)) {
                $resturants_liked_array[] = array('userid' => $userid, 'resturant_id' => $resturant['resturant_id'], 'name' => $resturant['name'], 'rating' => $resturant['rating'], 'image' => $resturant['image'], 'address' => $resturant['address']);
            
        }
        echo json_encode($resturants_liked_array);
        mysqli_close($conn);
    }

?>