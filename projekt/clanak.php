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
        <title>Article</title>
    </head>
    <body class="body_clanka">
    <header class="header_clanka">
        <h1 class="rally_news">Rally News</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="wrc.php">WRC</a></li>
                <li><a href="erc.php">ERC</a></li>
                <li><a href="administration.php">Administration</a></li>
            </ul>
        </nav>
    </header>
    <article class="article_article">
        <?php
            if(isset($_GET["id"])){
                $article_id=$_GET["id"];
                $query = 'SELECT * FROM clanci WHERE id='.$article_id;
                $result = mysqli_query($conn, $query) or die('Error querying database 4.');
                $row=mysqli_fetch_array($result);

                $formattedDate = date('d.m.y', strtotime($row["date"]));

                echo '

                <section class="head_article">
                    <h1 class="title_h1">'.$row['title'].'</h1>
                </section>
                <section class="date">
                    <p>&#x1F553; '.$formattedDate.'</p>
                </section>
                <img class="big_image" src="images/'.$row["image_title"].'" alt="Article image missing">
                <section class="text_of_article">
                    <p>'.$row["text"].'</p>
                </section>

                <hr>
                
                ';

                mysqli_close($conn);
            }
        ?>
    </article>
        <footer>
            <p>&copy; 2023 Rally News. All rights reserved.</p>
         </footer>
    </body>
</html>