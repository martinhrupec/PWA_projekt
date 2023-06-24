<?php
session_start();

$error_message = "";
$hi_message = "";

if (isset($_POST['logout'])) {
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        $_SESSION['logged_in'] = false;
        session_unset();
        session_destroy();
        $hi_message = "Logout successful!";
    } else {
        $error_message = "You can't logout if you haven't logged in!";
    }
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
            <form method="post" action="logout.php">
                <button class="logout-button" type="submit" name="logout">Logout</button>
            </form>
            <div class="error-container">
                    <?php echo $error_message; ?>
            </div>
            <div class="hi-container">
                <?php echo $hi_message; ?>
            </div>
        </article>
    </body>
</html>