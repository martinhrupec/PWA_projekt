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

            $error_message = "";
            $hi_message = "";

            if (isset($_POST['submit'])) {
                $title = $_POST['title'];
                $text = $_POST['text'];
                $image_title = $_POST['image_title'];
                $category = $_POST['category'];
                $date = date("Y-m-d"); // trenutni datum

                $insertQuery = "INSERT INTO clanci (title, text, image_title, category, date) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $insertQuery);
                mysqli_stmt_bind_param($stmt, "sssss", $title, $text, $image_title, $category, $date);
                mysqli_stmt_execute($stmt);

                $hi_message = "Article added successfully.";
            }

            echo '<form class="add-article-form" method="post">';
            echo '<input type="text" name="title" placeholder="Title" required><br>';
            echo '<textarea name="text" placeholder="Text" required></textarea><br>';
            echo '<input type="text" name="image_title" placeholder="Image Title" required><br>';
            echo '<input type="text" name="category" placeholder="Category" required><br>';
            echo '<button class="add-button" type="submit" name="submit" value="Submit">Add Article</button>';
            echo '</form>';

            mysqli_close($conn);
        ?>
            <div class="hi-container">
                <?php echo $hi_message; ?>
            </div>
        </article>
    </body>
</html>
