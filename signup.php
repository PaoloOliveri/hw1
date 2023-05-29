<?php
    require_once 'auth.php';

    if (checkAuth()) {
        header("Location: home.php");
        exit;
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["name"]) && 
        !empty($_POST["surname"]) && !empty($_POST["confirm_password"]))
    {
        $error = array();
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $query = "SELECT username FROM users WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Username già utilizzato";
            }
        }

        if (strlen($_POST["password"]) < 8) {
            $error[] = "Caratteri password insufficienti";
        } 

        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "Le password non coincidono";
        }

        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO users(username, password, name, surname) VALUES('$username', '$password', '$name', '$surname')";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["_username"] = $_POST["username"];
                $_SESSION["_user_id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }

        mysqli_close($conn);
    }
    else if (isset($_POST["username"])) {
        $error = array("Riempi tutti i campi");
    }


?>

<html>
    <head>
        <link rel="stylesheet" href="signup.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="tour_operator_favicon.ico">
        <script src="https://kit.fontawesome.com/f0a5dc1a82.js" crossorigin="anonymous"></script>
        <script src="signup.js" defer></script>
        <title>Tour Operator</title>
    </head>
    <body>
    
        <form name='login' method='post' id = 'login_form' method='post' enctype="multipart/form-data" autocomplete="off">
            <h1>SIGN UP</h1>
            <div>
                <h3>Name</h3>
                <label class="UP"><span class="fa-regular fa-circle-user"></span><input type= "text" name="name" id="name" placeholder="Type your name" <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?>></label>
                <div class="Err"><span class="fas fa-sharp fa-light fa-paperclip"></span><span> Inserire in nome</span></div>
            </div>

            <div>
                <h3>Surname</h3>
                <label class="UP"><span class="fa-regular fa-circle-user"></span><input type= "text" name="surname" id="surname" placeholder="Type your surname" <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?>></label>
                <div class="Err"><span class="fas fa-sharp fa-light fa-paperclip"></span><span> Inserire in cognome</span></div>
            </div>

            <div>
                <h3>Usermane</h3>
                <label class="UP"><span class="fa-regular fa-circle-user"></span><input type= "text" name="username" id="username" placeholder="Type your username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>></label>
                <div class="Err"><span class="fas fa-sharp fa-light fa-paperclip"></span><span> Username già in uso</span></div>
            </div>

            <div>
                <h3>Password</h3>
                <label class="UP"><span class="fas fa-regular fa-lock"></span><input type= "password" name="password" id="password" placeholder="Type your password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></label>
                <div class="Err"><span class="fas fa-sharp fa-light fa-paperclip"></span><span> Numero di caratteri minimo 8</span></div>
            </div>

            <div>
                <h3>Repeat Password</h3>
                <label class="UP"><span class="fas fa-regular fa-lock"></span><input type= "password" name="confirm_password" id="confirm_password" placeholder="Type your password" <?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>></label>
                <div class="Err"><span class="fas fa-sharp fa-light fa-paperclip"></span><span> Password diverse</span></div>
            </div>
         
            <?php if(isset($error)) {
                        foreach($error as $err) {
                            echo "<div class='errorj'><span class='fas fa-sharp fa-light fa-paperclip'></span><span>".$err."</span></div>";
                        }
            }?>

            <label id="signup_button"><input type = 'submit' name="submit" value="Sing Up"><span class="fas fa-regular fa-arrow-right-to-bracket"></span></label>
            <a href="login1.php">Hai già un account</a>

        </form>
    </body>
</html>