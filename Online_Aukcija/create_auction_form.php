<?php
session_start();
if (!isset($_SESSION['logged'])) {
    header('Location: login_form.php');
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Online auction</title>
        <link rel="stylesheet" href="assets/main.css">
        <link rel="stylesheet" href="assets/bootstrap.min.css">
    </head>
    <!DOCTYPE html>
    <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="Online Aukcija">
            <meta name="author" content="Bojan Sovtic">

            <title>Online Auction</title>

            <link href="assets/bootstrap.min.css" rel="stylesheet">
            <link href="assets/main.css" rel="stylesheet">

        </head>

        <body  class="parallax">

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                <div class="container">
                    <a class="navbar-brand" href="#">Online Auction</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="create_auction_form.php">Create Auction</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="my_auctions.php">My Auctions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login_form.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="registration_form.php">Registration</a>
                            </li>

                            <li class="nav-item">
                                <?php
                                if (isset($_SESSION['logged'])) {
                                    echo "<li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"logout.php\">Logout</a>
                            </li>";
                                    echo '<a class="nav-link user-logged" href="my_auctions.php">' . $_SESSION['name'] . '</a>';
                                }
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <form action="create_auction.php" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col">
                        <label for="title">Title:</label>
                        <input type="text" id ="title" name="title" class="form-control" required><br>

                        <label for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control rounded-0" rows="10" required></textarea><br>

                        <label for="expires">Expires at:</label>
                        <input type="datetime-local" id="expires" name="expires" class="form-control" required><br>
                    </div>
                    <div class="col">
                        <label for="starting">Starting price:</label>
                        <input type="number" id="starting" name="starting" class="form-control" required><br>

                        <label for="buyout">Buyout price (optional):</label>
                        <input type="number" id="buyout" name="buyout" class="form-control"><br>

                        <label for="category">Category:</label>
                        <select id="category" name="category" class="form-control">
                            <?php
                            include 'db.php';

                            $dbhost = 'localhost';
                            $dbuser = 'root';
                            $dbpass = '';
                            $dbname = 'auctions';

                            $db = new db($dbhost, $dbuser, $dbpass, $dbname);

                            $query = $db->query('SELECT name FROM categories')->fetchAll();


                            foreach ($query as $item) {
                                $name = $item['name'];
                                echo "<option value=\"$name\">" . $name . "</option>";
                                ;
                            }

                            $db->close();
                            ?>
                        </select><br>

                        <label for="picture">Select image to upload:</label>
                        <input type="file" name="picture" id="picture">
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit"  class="btn btn-primary">
                        Create new auction
                    </button>
                </div>
            </form>

            <footer class="py-5 bg-dark">
                <div class="container">
                    <p class="m-0 text-center text-white">Copyright &copy; Bojan Sovtic 2019</p>
                </div>
            </footer>
        </body>


    </html>