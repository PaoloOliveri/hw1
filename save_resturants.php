<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    saved_resturants();

    function saved_resturants(){
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $rating = mysqli_real_escape_string($conn, $_POST['rating']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);

        $query = "SELECT * FROM resturants WHERE username = '$userid' AND resturant_id = '$id'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
        if(mysqli_num_rows($res) > 0) {
            //echo json_encode(array('ok' => true));
            
            $query = "DELETE FROM resturants WHERE username = '$userid' AND resturant_id = '$id'";
            error_log($query);

            if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
                echo json_encode(array('ok' => true, 'result' => 'deleted', 'id_resturant' => $_POST['id']));
                exit;
        }
            mysqli_close($conn);
            echo json_encode(array('ok' => false));
            exit;
        }

        $query = "INSERT INTO resturants(username, resturant_id, name, rating, image, address) VALUES('$userid','$id', '$name', '$rating', '$image', '$address')";
        error_log($query);

        if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
            echo json_encode(array('ok' => true, 'result' => 'saved', 'id_resturant' => $_POST['id']));
            exit;
        }

        mysqli_close($conn);
        echo json_encode(array('ok' => false));

    }


?>