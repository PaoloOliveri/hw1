<?php
    include 'auth.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"]) )
    {
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $query = "SELECT * FROM users WHERE username = '".$username."'";

        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));;
        
        if (mysqli_num_rows($res) > 0) {
            $entry = mysqli_fetch_assoc($res);
            if (password_verify($_POST['password'], $entry['password'])) {

                $_SESSION["_username"] = $entry['username'];
                $_SESSION["_user_id"] = $entry['id'];
                header("Location: home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }
        $error = "Username e/o password errati.";
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
        $error = "Inserisci username e password.";
    }

?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="tour_operator_favicon.ico">
    <script src="https://kit.fontawesome.com/f0a5dc1a82.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="login.css">
    <script src="login.js" defer></script>
    <title>Tour Operator</title>
</head>
<body>
    
    <?php
        if(isset($error)){
            echo "<p class='error'>$error</p>";
        }
    ?>
    <form name='login' method='post' id = 'login_form'>
        <h1>Login</h1>
        <div>
            <h3>Usermane</h3>
                
                <label class="UP"><span class="fa-regular fa-circle-user"></span><input type= "text" name="username" id="username" placeholder="Type your username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>></label>
        </div>
        <div>
            <h3>Password</h3>
            
            <label class="UP"><span class="fas fa-regular fa-lock"></span><input type= "password" name="password" id="password" placeholder="Type your password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></label>
        </div>
        <label id="login_button"><input type = 'submit' name="submit" value="Sing In"><span class="fas fa-regular fa-arrow-right-to-bracket"></span></label>
        <a href="signup.php">Create your Account</a>

    </form>
</body>
</html>