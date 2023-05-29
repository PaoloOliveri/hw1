<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <?php 
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM users WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);   
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="tour_operator_favicon.ico">
    <script src="https://kit.fontawesome.com/f0a5dc1a82.js" crossorigin="anonymous"></script>
    <title>Tour Operator</title>
    <link rel="stylesheet" href="profile.css">
    <script src="profile.js" defer></script>
    </head>

    <body>
        <header id="id-header">
                <div id="menu">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <nav id="id-nav">
                        
                        <h1>
                            TRAVEL ASSISTANT
                        </h1>
                        <div id="selected_input">
                            <a href="home.php">Home</a>
                            <a href="resturants.php">Resturants</a>
                            <a href="">Cars</a>
                            <a href="">Attractions</a>
                        </div>
                        <div id="links"> 
                            <a id="links-button" href="logout.php">Logout</a>
                        </div>
                </nav>
            
        </header>
            <div id="profile">
                <img src="img_profile.png" id="profile_img">
                <p><?php echo $userinfo['name']." ".$userinfo['surname'] ?></p>
               
            </div>

        <section id="view">
                
            </section>

        <footer>
        </footer>




    </body>



</html>