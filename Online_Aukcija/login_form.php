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

    <body class="parallax"> 
        <form action="login.php" method="post">
            <div class="container">
                <div class="form-row col-md-6 form-centrirano">
                    <label for="username">Username : </label>
                    <input type="text" id="username" name="username" class="form-control" required><br>
                    <label for="password">Password : </label>
                    <input type="password" id="password" name="password" class="form-control" required><br>
                    <input type="submit" class="btn btn-primary" value="Pošalji">
                </div>
            </div>
        </form>
    </body>
    <footer class="py-5 bg-dark fixed-bottom">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Bojan Sovtic 2019</p>
        </div>
    </footer>
</html>
