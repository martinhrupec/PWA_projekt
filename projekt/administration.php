
<?php
session_start();

if (!isset($_SESSION['logged_in'])) {

    $message = "You cannot open administration unless you are logged in.";
    $_SESSION['message'] = $message;
    header("Location: login.php");
    exit;
}

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
            <p style="font-size: 20px; text-align: center;">What would you like to do?</p>
            <div class="form-item">
                <a href="add.php"><button type="button" class="button">Add article</button></a>
                <a href="update.php"><button type="button" class="button">Update article</button></a>
                <a href="delete.php"><button type="submit" name="delete" value="Delete">Delete article</button>
            </div>
        </article>
    </body>
</html>