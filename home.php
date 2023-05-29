<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login1.php");
        exit;
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="tour_operator_favicon.ico">
        <script src="https://kit.fontawesome.com/f0a5dc1a82.js" crossorigin="anonymous"></script>
        <title>Tour Operator</title>
        <link rel="stylesheet" href="home.css">
        <script src="home.js" defer></script>
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
                    <a href="resturants.php">Resturants</a>
                    <a href="">Cars</a>
                    <a href="">Attractions</a>
                </div>
                <div id="links">
                    <a href="profile.php"><img src="img_profile.png" id="profile_img"></a>
                    <div></div>
                    <a id="links-button" href="logout.php">Logout</a>
                </div>
            </nav>  
        </header>
        <div id="title">
            <h1>Find Next Place To Visit</h1>
            <h3>Your Trip Start Here</h3>
        </div>
    <section>
    </section>
    <footer>

    </footer>
    </body>
</html>