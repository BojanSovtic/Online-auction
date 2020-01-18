<?php
session_start();


if (isset($_POST['username'])) {
    $username = htmlspecialchars($_POST['username']);
}

if (isset($_POST['password'])) {
    $password = htmlspecialchars($_POST['password']);
}

include 'db.php';

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'auctions';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

$query = $db->query('SELECT user_id, username, password FROM users WHERE username = ?', $username)->fetchAll();


if (sizeof($query) > 0) {
    $result = $query[0];

    if (password_verify($password, $result['password'])) {
        session_regenerate_id();
        $_SESSION['logged'] = TRUE;
        $_SESSION['name'] = $username;
        $_SESSION['id'] = $result['user_id'];

        $cookie_name = "user";
        $cookie_value = $username;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        header('Location: index.php');
        echo 'Welcome ' . $_SESSION['name'] / '!';
    } else {
        // header('Location: login_form.php');
        echo 'Incorrect password!';
    }
} else {
    // header('Location: login_form.php');
    echo 'Incorect username!';
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sistem za upravljanje pacijentima</title>
        <link rel="stylesheet" href="assets/main.css">
        <link rel="stylesheet" href="assets/bootstrap.min.css">
    </head>
    <body>
    </body>
    <footer class="fixed-bottom">
        &copy; Copyright 2019 by Bojan Sovtic; 
    </footer>
</html>