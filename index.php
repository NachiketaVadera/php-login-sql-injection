<?php 
    if (isset($_POST['username'])) {
        $connection = mysqli_connect("localhost", "root", "");
        $database = mysqli_select_db($connection, "sql_injection");

        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM user_info WHERE uname='" . $username . "' AND pswrd='" . $password . "'";

        $result = mysqli_query($connection, $query);

        $rows = mysqli_num_rows($result);

        if ($rows == 1) {
            header("Location: http://localhost/login/home.php?user=" . $username);
        } else {
            header("Location: http://localhost/login/index.php?failed=true");
        }

        mysqli_close($connection);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/main.css" />
    <?php 
        if (isset($_GET['failed'])) {
            if ($_GET['failed'] == "true") {
                echo "<script>alert('Fuck Off!');</script>";
            }
        }
    ?>

</head>
<body>
    <div class="box">
        <p class="box_title">Login</p>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <p class="label">Username</p>
            <input type="text" name="username" class="input" pattern="[a-zA-Z0-9]+" required autofocus />
            <p class="label">Password</p>
            <input type="password" name="password" class="input" required /><br/>
            <input type="submit" value="Login" class="login" />
        </form>
    </div>
</body>
</html>