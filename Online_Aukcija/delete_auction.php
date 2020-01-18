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

$id = $_POST['id'];
$id = substr($id, 6);

$query = $db->query('DELETE FROM bids WHERE listing_id = ?', $id);
$query = $db->query('DELETE FROM listings WHERE listing_id = ?', $id);

echo "Deleted successfully!";

} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>