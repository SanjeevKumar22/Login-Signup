<?php
$login = false;
$showerr = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'partial/dbconnect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    // $sql = "SELECT * FROM `users` WHERE `username`='$username' AND `password`='$password'";
    $sql = "SELECT * FROM `users` WHERE `username`='$username'";
    $res = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($res);
    // echo $num;
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($res)) {
            if (password_verify($password, $row['password'])) {
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("location:welcome.php");
            }
            else {
                $showerr = "invalid Credentials";
            }
        }
    } 
    else {
        $showerr = "invalid Credentials";
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Login</title>
</head>

<body>
    <?php
    require 'partial/_nav.php';
    ?>
    <?php
    if ($login) {

        echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>success!</strong>Your Logged in
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <?php
    if ($showerr) {

        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> ' . $showerr . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <div class="container my-4">
        <h1 class="text-center">Login to Website</h1>
        <form action="/login/login.php" method="post">
            <div class="mb-3 ">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="11" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3 ">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="11" class="form-control" id="password" name="password">
            </div>



            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>