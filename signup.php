<?php
$err = false;
$showerr = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'partial/dbconnect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $exits = false;
    $exitssql = "select * from users where username='$username'";
    $res = mysqli_query($conn, $exitssql);
    $numexist = mysqli_num_rows($res);
    if ($numexist > 0) {
        $showerr = 'Username already Exists';
    } else {
        $exits = false;
        if ($password == $cpassword) {
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` ( `username`, `password`,`dt`) VALUES ('$username', '$hash',current_timestamp())";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                $err = true;
            }
        } else {
            $showerr = 'password do not match';
        }
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

    <title>Signup</title>
</head>

<body>
    <?php
    require 'partial/_nav.php';
    ?>
    <?php
    if ($err) {
        echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>success!</strong>Account has been Created
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
        <h1 class="text-center">Signup to Website</h1>
        <form action="/login/signup.php" method="post">
            <div class="mb-3 ">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="11" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3 ">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="11" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 ">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <div id="emailHelp" class="form-text">Make sure to type same password</div>
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
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