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
        <?php
            $servername = "localhost:3307";
            $username = "root";
            $password = "";
            $database = "rally_news_db";

            $conn = mysqli_connect($servername, $username, $password, $database);

            if (!$conn) {
                die("Neuspješna konekcija: " . mysqli_connect_error());
            }

            $hi_message = "";

            if (isset($_POST['delete'])) {
                $articleID = $_POST['article_id'];
                $deleteQuery = "DELETE FROM clanci WHERE id = $articleID";
                mysqli_query($conn, $deleteQuery) or die('Error deleting article.');
                $hi_message = "Article deleted successfully.";
            }

            $query = 'SELECT * FROM clanci';
            $result = mysqli_query($conn, $query) or die('Error querying database.');

            echo '<form class="radio-button-form" method="post">';

            while($row = mysqli_fetch_array($result)){
                $title = $row["title"];
                $id = $row["id"];
                echo '<input type="radio" name="article_id" value="'.$id.'">'.$title.'<br>';
              };
            
            echo '<button class="delete-button "type="submit" name="delete" value="Delete">Delete</button>';
            echo '</form>';
            
            mysqli_close($conn);
        ?>
            <div class="hi-container">
                <?php echo $hi_message; ?>
            </div>
        </article>
    </body>
</html>