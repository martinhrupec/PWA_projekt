<?php

session_start();

if (isset($_SESSION['message'])) {

    $failed_administration_message = $_SESSION['message'];
    unset($_SESSION['message']);
}

$servername = "localhost:3307";
$username = "root";
$password = "";
$database = "rally_news_db";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Neuspješna konekcija: " . mysqli_connect_error());
}

//echo "Uspješno ste spojeni na bazu podataka";

$error_message = "";
$hi_message = "";

if (isset($_POST["name"]) && isset($_POST["last_name"]) && isset($_POST["password"])) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM korisnici WHERE name = ? AND last_name = ?");
    mysqli_stmt_bind_param($stmt, "ss", $_POST["name"], $_POST["last_name"]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1 && $_POST["password"] === mysqli_fetch_assoc($result)["password"]) {
        $hi_message = "Login successfull!";
        $_SESSION['logged_in'] = true;
    } else {
        $error_message = "Wrong name, last name, or password";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Rally news</title>
    </head>
    <body>
        <header>
            <h1 class="rally_news">Rally News</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="registration.php">Registration</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="administration.php">Administration</a></li>
                </ul>
            </nav>
        </header>
        <article class="article_article">
            <form method="post" action="login.php">
                <div class="form-item">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" required>
                </div>

                <div class="form-item">
                    <label for="last_name">Last name:</label>
                    <input type="text" name="last_name" id="last_name" required>
                </div>

                <div class="form-item">
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" required>
                </div>

                <div class="form-item">
                    <button type="submit" name="submit">Login</button>
                </div>

                <div class="error-container">
                    <?php echo $error_message; ?>
                </div>

                <div class="hi-container">
                    <?php echo $hi_message; ?>
                </div>

                <div class="error-container">
                    <?php
                        if(isset($failed_administration_message)){
                            echo $failed_administration_message;
                        } 
                    ?>
                </div>
            </from>
        </article>
    </body>
</html>