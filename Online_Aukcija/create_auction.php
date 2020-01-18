<?php

session_start();
if (!isset($_SESSION['logged'])) {
    header('Location: login_form.php');
}

if (isset($_POST['title'])) {
    $title = htmlspecialchars($_POST['title']);
}

if (isset($_POST['description'])) {
    $description = htmlspecialchars($_POST['description']);
}

if (isset($_POST['expires'])) {
    $expires = htmlspecialchars($_POST['expires']);
}

if (isset($_POST['starting'])) {
    $starting = htmlspecialchars($_POST['starting']);
}

if (isset($_POST['buyout'])) {
    $buyout = htmlspecialchars($_POST['buyout']);
}

if (isset($_POST['category'])) {
    $category = htmlspecialchars($_POST['category']);
}

$target_dir = "auctions/$category/";
$target_file = $target_dir . basename($_FILES['picture']['name']);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$check = getimagesize($_FILES['picture']['tmp_name']);
if ($check !== false) {
    echo "File is an image - " . $check['mime'] . ".";
    $uploadOk = 1;
} else {
    echo "File is not an image.";
    $uploadOk = 0;
}

if (file_exists($target_file)) {
    echo "Sorry, file already existss.";
    $uploadOk = 0;
}

if ($_FILES['picture']['size'] > 5000000) {
    echo "Sorry, your files is too large.";
    $uploadOk = 0;
}

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG and GIF files are allowed.";
    $uploadOk;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    include 'db.php';

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'auctions';

    $db = new db($dbhost, $dbuser, $dbpass, $dbname);

    $userId = $_SESSION['id'];
    $categoryId = $db->query('SELECT category_id FROM categories WHERE name = ?', $category)->fetchArray();
    $categoryId = $categoryId['category_id'];

    $db->query('INSERT INTO listings(expires_at, buyout_price, starting_price, title, 
        description, image_path, user_id, category_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)', $expires, $buyout, $starting, $title, $description, $target_file, $userId, $categoryId);

    echo "    " . $target_file;
    if (move_uploaded_file($_FILES['picture']['tmp_name'], $target_file)) {
        echo "File has been uploaded";
    }

    $db->close();
    
    header( 'Location: my_auctions.php');
    exit;
}
?>
