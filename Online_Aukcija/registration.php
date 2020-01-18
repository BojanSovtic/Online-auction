<?php
session_start();
require "functions.php";

$greske = [];

if (isset($_POST['username'])) {
    $username = htmlspecialchars($_POST['username']);
}
if (proveriUsername($username) !== '0') {
    $greske[] = proveriUsername($username);
}

if (isset($_POST['password'])) {
    $password = htmlspecialchars($_POST['password']);
}
if (proveriLozinku($password) !== '0') {
    $greske[] = proveriLozinku($password);
} else {
    $password = password_hash($password, PASSWORD_DEFAULT);
}
if (isset($_POST['passwordConf'])) {
    $passwordConf = htmlspecialchars($_POST['passwordConf']);
}

if (isset($_POST['forename'])) {
    $forename = htmlspecialchars($_POST['forename']);
}

if (isset($_POST['surname'])) {
    $surname = htmlspecialchars($_POST['surname']);
}

if (isset($_POST['bankAccount'])) {
    $bankAccount = htmlspecialchars($_POST['bankAccount']);
}

if (isset($_POST['shippingAddress'])) {
    $shippingAddress = htmlspecialchars($_POST['shippingAddress']);
}

if (isset($_POST['payment'])) {
    $payment = htmlspecialchars($_POST['payment']);
}


if (isset($_POST['address'])) {
    $address = htmlspecialchars($_POST['address']);
}

if (isset($_POST['phone'])) {
    $phone = htmlspecialchars($_POST['phone']);
}


if (isset($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);
}
if (proveriEmail($email) !== '0') {
    $greske[] = proveriEmail($email);
}
if (isset($_POST['emailConf'])) {
    $emailConf = htmlspecialchars($_POST['emailConf']);
}
if ($email !== $emailConf) {
    $greske[] = "Potvrdite email ponovo!";
}

if (isset($_POST['brojGenerisan'])) {
    $brojGenerisan = htmlspecialchars($_POST['brojGenerisan']);
}
if (isset($_POST['broj'])) {
    $broj = htmlspecialchars($_POST['broj']);
}
if (!is_numeric($broj)) {
    $greske[] = "Morate uneti broj.";
}

if ($brojGenerisan !== $broj) {
    $greske[] = "Niste dobro uneli broj!";
}


if (sizeof($greske) == 0) {
    include 'db.php';

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'auctions';

    $db = new db($dbhost, $dbuser, $dbpass, $dbname);


    $db->query('INSERT INTO customers (bank_account_number, shipping_address, payment_method) 
        VALUES (?, ?, ?)', $bankAccount, $shippingAddress, $payment);

    $customer_id = $db->query('SELECT customer_id FROM customers WHERE bank_account_number = ?', $bankAccount)->fetchArray();
    $customer_id = $customer_id['customer_id'];

    $db->query('INSERT INTO users (username, password, forename, surname, address, phone, '
            . 'email, customer_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', $username, $password, $forename, $surname, $address, $phone, $email, $customer_id);

    $db->close();
    echo "<div class=\"potvrda\"> 
                <p class=\"uspeh\">Uspesno ste se registrovali!</p>
                <a href=\"login_form.php\"><button class=\"btn btn-primary\">Home</button></a>
        </div>";
} else {
    echo "<div class=\"greska\">";
    foreach ($greske as $greska) {
        echo "<p class=\"error\">" . $greska . "</p>";
    };
    echo
    "<a href=\"registration_form.php\"><button class=\"btn btn-primary\">Nazad</button></a>
    </div>";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset=""utf-8">
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






