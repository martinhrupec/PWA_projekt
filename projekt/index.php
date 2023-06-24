<?php
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $database = "rally_news_db";
    
    $conn = mysqli_connect($servername, $username, $password, $database);
    
    if (!$conn) {
        die("Neuspješna konekcija: " . mysqli_connect_error());
    }
    
    //echo "Uspješno ste spojeni na bazu podataka";
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
                <li><a href="#">Home</a></li>
                <li><a href="registration.php">Registration</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="administration.php">Administration</a></li>
            </ul>
        </nav>
    </header>
    <div class="main">
        <h2>WRC</h2>
        <hr>
        <section class="clanci">
        <?php
            $query='SELECT * FROM clanci WHERE category="WRC"';
            $result = mysqli_query($conn, $query) or die('Error querying database.');
            while($row = mysqli_fetch_array($result)){
              echo '<div class="clanak">
                        <a href="clanak.php?id='.$row["id"].'">
                            <img class="home_image" src="images/'.$row["image_title"].'" alt="Article image missing">
                            <h3>'.$row["title"].'</h3>
                        </a>
                    </div>';
            };
        ?>
        </section>
        <h2>ERC</h2>
        <hr>
        <section class="clanci">
        <?php
            $query='SELECT * FROM clanci WHERE category="ERC"';
            $result = mysqli_query($conn, $query) or die('Error querying database.');
            while($row = mysqli_fetch_array($result)){
              echo '<div class="clanak">
                        <a href="clanak.php?id='.$row["id"].'">
                            <img class="home_image" src="images/'.$row["image_title"].'" alt="Article image missing">
                            <h3>'.$row["title"].'</h3>
                        </a>
                    </div>';
            };
            mysqli_close($conn);
        ?>
        </section>
    </div>

    <footer>
        <p>&copy; 2023 Rally News. All rights reserved.</p>
    </footer>
</body>
</html>
