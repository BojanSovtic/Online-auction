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

$buyout= $_POST['buyout'];
$id = $_POST['id'];
$id = substr($id, 6);


$query = $db->query('UPDATE listings SET buyout_price = ? WHERE listing_id = ?', $buyout, $id);

$db->close();


//header('Location: my_auctions.php');
//exit();
echo "Updated successfully!";



} catch (Exception $ex) {
    echo $ex->getMessage();
}


?>