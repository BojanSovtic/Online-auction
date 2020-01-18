<?php
session_start();
if (!isset($_SESSION['logged'])) {
    header('Location: login_form.php');
}
?>


<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Online Aukcija">
        <meta name="author" content="Bojan Sovtic">

        <title>My Auctions</title>

        <link href="assets/bootstrap.min.css" rel="stylesheet">
        <link href="assets/main.css" rel="stylesheet">
        <script accesskey=" "src="https://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
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

                        <li class="nav-item">
                            <a class="nav-link" href="create_auction_form.php">Create Auction</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="my_auctions.php">My Auctions</a>
                        </li>
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

        <div class="container">

            <div class="row row-my">


                <div class="col-lg-9">

                    <div class="row">

                        <?php
                        include 'db.php';

                        $dbhost = 'localhost';
                        $dbuser = 'root';
                        $dbpass = '';
                        $dbname = 'auctions';
                        $user_id = $_SESSION['id'];

                        try {
                            $db = new db($dbhost, $dbuser, $dbpass, $dbname);

                            $sql = $db->query('SELECT *'
                                            . ' FROM listings WHERE expires_at > NOW() AND user_id = ? '
                                            . 'ORDER BY expires_at ASC', $user_id)->fetchAll();

                            $num_of_pages = count($sql);

                            $result_per_page = 6;

                            if (!isset($_GET["page"])) {
                                $page = 1;
                            } else {
                                $page = $_GET["page"];
                            }

                            $pages = ceil($num_of_pages / $result_per_page);
                            $func = ($page - 1) * $result_per_page;

                            $sql = $db->query('SELECT *'
                                            . ' FROM listings WHERE expires_at > NOW() AND user_id = ? '
                                            . 'ORDER BY expires_at ASC LIMIT ' . $func . ', 6', $user_id)->fetchAll();

                            foreach ($sql as $row) {
                                $image = $row['image_path'];
                                $title = $row['title'];
                                $description = $row['description'];
                                $expires_at = $row['expires_at'];
                                $buyout_price = $row['buyout_price'];
                                $id = $row['listing_id'];

                                if ($buyout_price == 0)
                                    $buyout_price = 'Not set';
                                else
                                    $buyout_price .= '$';

                                $starting_price = $row['starting_price'];

                                $highest_bid = $db->query('SELECT MAX(amount)FROM bids '
                                                . 'INNER JOIN listings ON bids.listing_id = listings.listing_id '
                                                . 'WHERE bids.listing_id = ?;', $id)->fetchArray();

                                $highest_bid = $highest_bid['MAX(amount)'] . "$";
                                if ($highest_bid == '' || $highest_bid == "$")
                                    $highest_bid = 'No bids.';

                                echo "<div class=\"col-lg-4 col-md-6 mb-4\">
                            <div class=\"card h-100\">
                                <a href=\"#\"><img class=\"card-img-top\" src=\"$image\" alt=\"Picture unavailable\"></a>
                                <div class = \"card-body\">
                                    <h4 class=\"card-title\">
                                        <a href=\"#\">" . $title . "</a>
                                    </h4>
                                      <h5>Highest bid: " . $highest_bid . "</h5>
                                    <h5>Buyout price: " . $buyout_price . "</h5>
                                    <p class=\"card-text\">" . $description . "</p>
                                </div>
                                <div class=\"card-footer\">
                                    <small class=\"card-footer\">Expires: " . $expires_at . "</small><br><br>
				    <small class=\"card-footer\">Starting price: " . $starting_price . "$</small>
                                </div></br>
                                
                                <input type=\"text\" id=\"buyout$id\" name=\"buyout\" class=\"form-control\" placeholder=\"Update buyout price:\">
                                <input type=\"submit\" class=\"btn btn-primary update\" value=\"Update buyout price\">
                                <input class=\"btn btn-primary delete\" type=\"button\" value=\"Delete\">
                               

                            </div>
                        </div>";
                            }

                            echo "<div class='my-center'>";
                            echo "<p class='my-pagination'>";
                            for ($i = 1; $i <= $pages; $i++) {
                                echo "<a href='my_auctions.php?page=" . $i . "'>" . $i . " </a>";
                            }
                            echo '</p>';
                            echo "</div>";
                        } catch (Eception $ex) {
                            echo $ex->getMessage();
                        }
                        ?>

                    </div>

                </div>

            </div>

        </div>




        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Bojan Sovtic 2019</p>
            </div>
        </footer>

        <script>

            $(document).ready(function () {
                $(".update").click(function () {
                    var button = this;
                    var id = $(button).siblings('[name="buyout"]').attr("id");
                    var result = "#" + id;

                    var buyout = $(result).val();

                    $.ajax({
                        url: 'update_auction.php',
                        method: 'POST',
                        data: {
                            buyout: buyout,
                            id: id
                        },
                        success: function (response) {
                            alert(response);
                        }
                    });
                    location.reload();
                });
            });

            $(document).ready(function () {
                $(".delete").click(function () {
                    var button = this;
                    var id = $(button).siblings('[name="buyout"]').attr("id");

                    $.ajax({
                        url: 'delete_auction.php',
                        method: 'POST',
                        data: {
                            id: id
                        },
                        success: function (response) {
                            alert(response);
                        }
                    });
                    location.reload();
                });
            });


        </script>  
    </body>

</html>