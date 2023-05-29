<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
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
        <link rel="stylesheet" href="resturants.css">
        <script src="resturants.js" defer></script>
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
            <!--</div>-->
                <div id="selected_input">
                    <a href="home.php">Home</a>
                    <a href="">Cars</a>
                    <a href="">Attractions</a>
                </div>
                <div id="links">
                    <a href="profile.php">
                        <img src="img_profile.png" id="profile_img">
                    </a>
                    <div></div>
                    <a id="links-button" href="logout.php">Logout</a>
                </div>
            </nav>
            <h2>
                RESTURANTS
            </h2>

            <form name='resturants_form' id = 'resturants_form'>
                <div>
                    <h3>City</h3>
                    <label class="UP"><span class="fas fa-sharp fa-light fa-drumstick-bite"></span><input type= "text" name="city" id="city" placeholder="Type your city" ></label>
                </div>
                <div>
                    <h3>Type food</h3>
                    <label class="UP"><span class="fas fa-sharp fa-light fa-location-dot"></span><input type= "text" name="food" id="food" placeholder="Type of Food " ></label>
                </div>
                <div id="submit">
                    <input type='submit' value="Cerca" id="submit">
                </div>
        </header>
    
        <section id = "view">
        </section>
        <section id = "modal-view" class="hidden"></section>
        <footer>
        </footer>
    </body>
</html>