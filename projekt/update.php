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
                if (isset($_POST['article_id'])) {
                    $articleID = $_POST['article_id'];
                    $title = $_POST['title'];
                    $text = $_POST['text'];
                    $image_title = $_POST['image_title'];
                    $category = $_POST['category'];

                    $updateQuery = "UPDATE clanci SET title=?, text=?, image_title=?, category=? WHERE id=?";
                    $stmt = mysqli_prepare($conn, $updateQuery);
                    mysqli_stmt_bind_param($stmt, "ssssi", $title, $text, $image_title, $category, $articleID);
                    mysqli_stmt_execute($stmt);

                    $hi_message = "Article updated successfully.";
                } else {
                    $error_message = "Please select an article.";
                }
            }

            $query = 'SELECT * FROM clanci';
            $result = mysqli_query($conn, $query) or die('Error querying database.');

            echo '<form class="update-article-form" method="post">';

            while($row = mysqli_fetch_array($result)){
                $title = $row["title"];
                $text = $row["text"];
                $image_title = $row["image_title"];
                $category = $row["category"];
                $id = $row["id"];

                echo '<input type="radio" name="article_id" value="'.$id.'">'.$title.'<br>';
                echo '<input type="text" name="title" value="'.$title.'" placeholder="Title" required><br>';
                echo '<textarea name="text" placeholder="Text" required>'.$text.'</textarea><br>';
                echo '<input type="text" name="image_title" value="'.$image_title.'" placeholder="Image Title" required><br>';
                echo '<input type="text" name="category" value="'.$category.'" placeholder="Category" required><br>';
            };

            echo '<button class="update-button" type="submit" name="submit" value="Submit">Update Article</button><br><br>';
            echo '</form>';

            if (!empty($error_message)) {
                echo '<div class="error-message">' . $error_message . '</div>';
            }

            mysqli_close($conn);
        ?>
            <div class="hi-container">
                <?php echo $hi_message; ?>
            </div>
        </article>
    </body>
</html>
