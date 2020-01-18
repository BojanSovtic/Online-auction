<?php

session_start();
if (!isset($_SESSION['logged'])) {
    header('Location: login_form.php');
}

try {

    include 'db.php';
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'auctions';

    $db = new db($dbhost, $dbuser, $dbpass, $dbname);

    $bid = $_POST['bid'];
    $user_id = $_SESSION['id'];
    $id = $_POST['id'];
    $id = substr($id, 3);


    $query = $db->query('SELECT user_id, buyout_price FROM listings WHERE listing_id = ?', $id)->fetchArray();
    $owner_id = $query['user_id'];

    if ($owner_id == $user_id)
        exit("You can't bid on your own auction!");

    $buyout_price = $query['buyout_price'];

    echo $bid . "  " . $buyout_price;
    if ($bid == $buyout_price && $buyout_price != 0) {
        $query = $db->query('DELETE FROM bids WHERE listing_id = ?', $id);
        $query = $db->query('DELETE FROM listings WHERE listing_id = ?', $id);
        exit("You have just bought this item.");
    }

    $query = $db->query('INSERT INTO bids (amount, user_id, listing_id) '
            . ' VALUES (?, ?, ?)', $bid, $user_id, $id);

    echo "Bid created.";

    $db->close();

// header('Location: index.php');
// exit;

} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>