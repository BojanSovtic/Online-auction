<?php
    session_start();
?>

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
        <script accesskey=" "src="https://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    </head>

    <body  class="parallax">
        <form action="registration.php" method="post">
            <div class="form-row">
                <div class="col">
                    <label for="username"> Username: </label> 
                    <input type="text" id="username" name="username" class="form-control" required><br>

                    <label for="password"> Password: </label>
                    <input type="password" id="password" name="password" class="form-control" required><br>

                    <label for="passwordConf"> Confirm password: </label>
                    <input type="password" id="passwordConf" name="passwordConf" class="form-control" required><br>

                    <label for="forename">Forename: </label>
                    <input type="text" id="forename" name="forename" class="form-control" required><br>

                    <label for="surname">Surname: </label>
                    <input type="text" id="surname" name="surname" class="form-control" required><br>

                    <label for="bankAccount">Bank account:</label>
                    <input type="text" id="bankAccount" name="bankAccount" class="form-control" required><br>

                    <label for="shippingAddress">Shipping address: </label>
                    <input type="text" id="shippingAddress" name="shippingAddress" class="form-control" required><br>

                    <label for="payment">Payment method: </label>
                    <select id="payment" name="payment" class="form-control" required>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Mobile Payment">Mobile Payment</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Ewallet">Ewallet</option>
                        <option value="Prepaid Card">Prepaid Card</option>
                        <option value="Direct Deposit">Direct Deposit</option>
                        <option value="Cash">Cash</option>
                    </select><br>


                </div>

                <div class="col">
                    <label for="addres">Address:</label>
                    <input type="text" id="address" name="address" class="form-control"><br>

                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" class="form-control"><br>

                    <label for="email">E-mail: </label>
                    <input type="email" id="email" name="email" class="form-control" required><br>

                    <label for="emailConf">Confirm E-mail: </label>
                    <input type="email" id="emailConf" name="emailConf" class="form-control" required><br>

                    <?php
                    $brojGenerisan = rand(100000, 10000000);
                    echo "<label for=\"brojGenerisan\">Generisan broj:</label>"
                    . "<input type='text' value='{$brojGenerisan}' id='brojGenerisan' name='brojGenerisan' class='form-control' readonly><br>";
                    ?>

                    <label for="broj">Confirm number: </label>
                    <input type="number" id="broj" name="broj" class="form-control"><br>

                    <div class="text-right">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </div>

            </div>
        </form>
    </body>
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Bojan Sovtic 2019</p>
        </div>
    </footer>

</html>
