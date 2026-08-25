<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM login 
         WHERE username='$username' 
         AND password='$password'"
    );

    if (mysqli_num_rows($query) > 0) {

        $data = mysqli_fetch_assoc($query);

        $_SESSION['username'] = $data['username'];

        header("Location: index.php");
        exit;

    } else {

        $error = "Username atau password salah.";

    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="login-container">

    <div class="login-box">

        <h1>Perpustakaan</h1>
        <p>Silakan login untuk melanjutkan</p>

        <?php if (isset($error)) { ?>

            <p class="error">
                <?= $error; ?>
            </p>

        <?php } ?>

        <form method="POST">

            <label>Username</label>

            <input
                type="text"
                name="username"
                required
            >

            <label>Password</label>

            <input
                type="password"
                name="password"
                required
            >

            <button type="submit" name="login">
                Login
            </button>

        </form>

    </div>

</div>

</body>
</html>