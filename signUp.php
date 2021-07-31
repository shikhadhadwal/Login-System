<?php
$showAlert = false;
$showError = false;
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include('partials/_dbconnect.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
      
    //check whether this user exist 
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        //$exist = true;
        $showError = "Username already exist";

    }
    else{
        $exist = false;

        //  validation
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);  //password hashing
            $sql = "INSERT INTO `users` (`username`, `password`, `dt`)VALUES('$username' ,'$hash' , current_timestamp() )";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = true;
            }
            else{
                $showError = "Password do not Match!";
                
            }
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
    <?php require 'partials/_navbar.php' ?>

    <!-- alert -->
    <?php
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sucess</strong> You account is now created and you can Login.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if($showError){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '.$showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>

    <!-- form -->
    <div class="container my-4">
    <h1 class="text-center">Signup to our Website</h1>
    <form action="/php_tutorial/loginSystem/signUp.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="11" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="22" class=" form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class=" form-control" id="cpassword" name="cpassword">
                <small id="emailHelp" class="form-text text-muted">Make sure to type the same Password</small>
                
            </div>
            
            <button type="submit" class="btn btn-primary ">Signup</button>
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