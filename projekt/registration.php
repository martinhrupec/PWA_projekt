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

$error_message = "";
$hi_message = "";

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $last_name = $_POST['last_name'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm_password'];
  $admin = true;

  $queryOne = 'SELECT name, last_name FROM korisnici WHERE name = ? AND last_name = ?';
  $stmtOne = mysqli_prepare($conn, $queryOne);
  mysqli_stmt_bind_param($stmtOne, 'ss', $name, $last_name);
  mysqli_stmt_execute($stmtOne);
  $resultOne = mysqli_stmt_get_result($stmtOne);

  if ($password !== $confirmPassword) {
    $error_message = "Passwords do not match.";
  }
  elseif(mysqli_num_rows($resultOne) > 0){
    $error_message .= " User with that name and last name already exists in database, please change it. It's only username.";
  }
  else {
    $insertQuery = "INSERT INTO korisnici (name, last_name, password, admin_rights) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, "sssb", $name, $last_name, $password, $admin);

    if (mysqli_stmt_execute($stmt)) {
      $hi_message = 'Successfull registration. Hello, '.$name.'!';
    } else {
      die('Error inserting user into database.');
    }

    mysqli_stmt_close($stmt); // Zatvaranje pripremljene izjave za umetanje novog korisnika
  }

  mysqli_stmt_close($stmtOne); // Zatvaranje pripremljene izjave za provjeru postojanja korisnika
}

mysqli_close($conn); // Zatvaranje veze s bazom podataka


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
        <script>
              function validateForm() {
                var name = document.querySelector('#name');
                var last_name = document.querySelector('#last_name');
                var password = document.querySelector('#password');

                name.style.border = '';
                last_name.style.border = '';
                password.style.border = '';

                if (name.value === '' || name.value.length < 2) {
                    name.style.border = '1px solid red';
                    return false;
                }

                if (last_name.value === '' || last_name.value.length < 2) {
                    last_name.style.border = '1px solid red';
                    return false;
                }

                if (password.value === '' || password.value.length < 5) {
                    password.style.border = '1px solid red';
                    return false;
                }
                return true;
            }
        </script>
        <article class="article_article">
            <form method="post" action="registration.php" onsubmit="return validateForm()">
                <div class="form-item">
                    <label for="name">Name <small>(at least 2 symbols)</small>:</label>
                    <input type="text" name="name" id="name" required>
                </div>

                <div class="form-item">
                    <label for="last_name">Last name <small>(at least 2 symbols)</small>:</label>
                    <input type="text" name="last_name" id="last_name" required>
                </div>

                <div class="form-item">
                    <label for="password">Password <small>(at least 5 symbols)</small>:</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <div class="form-item">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" name="confirm_password" id="confirm_password" required>
                </div>

                <div class="form-item">
                    <button type="submit" name="submit">Register</button>
                </div>

                <div class="error-container">
                    <?php echo $error_message; ?>
                </div>

                <div class="hi-container">
                    <?php echo $hi_message; ?>
                </div>
            </from>
        </article>
    </body>
</html>