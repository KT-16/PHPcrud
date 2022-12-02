<?php
session_start();
include "dbconn.php";
if (isset($_POST['signin'])) {
  // echo "1";
  $useremail = $_POST['mail'];
  $password = $_POST['password'];
  $sql    = "select * from intern where umail='$useremail'and upassword='$password'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    //   echo "<pre>";
    // print_r($row);
    // echo "</pre>";
    // exit;

    // $id = $row['uid'];
    $_SESSION['u_id'] = $userid;
    header("Location:new.php");
  }
}
// echo "3";
?>


<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="style.css" type="text/css">


  <title>Login</title>
  <style>
    label {
      font-size: larger;
      color: black;
    }

    form {
      display: flex;
      width: 100%;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    button {
      padding: 15px;
      margin: 10px 0px;
      width: 80px;
      margin-left: 100px;
    }
  </style>
</head>

<body>
  <div class="topnav">
    <a class="nav-link" href="https://www.stspl.com/"><img src="lg.jpg"></a>
    <h1>INTERNSHIP PORTAL</h1>
    <a class="nav-link" href="signin.php">Login</a>
    <a class="nav-link" href="signup.php">Registration</a>
  </div>
  <br><br><br>

  <h1 class="text-center">LOG IN</h1>
  <form name="signinform" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
    <div class="form-group col-md-6">

      <div>
        <label for="name">Email</label>
        <input type="text" class="form-control" id="mail" name="mail" placeholder="Enter your mail" autocomplete="off">
        <b><label id="mailerror" style="visibility:hidden; color:red; ">This Field Is Requierd</label></b>
        <b><label id="msg" style="color:red; "></label></b>
      </div>

      <div>
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Enter Password" autocomplete="off">
        <b><label id="passworderror" style="visibility:hidden; color:red; ">This Field Is Requierd</label></b>
      </div>
    </div>

    <button type="submit" name="signin" class="btn btn-primary">
      login
    </button>
  </form>

</body>

<script>
  function validateForm() {

    if (document.forms["signinform"]["mail"].value.trim() == "") {
      document.getElementById("mailerror").style.visibility = "visible";
      return false;
    }
    var mail =document.signinform.mail.value;
    var p1=/^[A-Za-z0-9._%+-]+@STSPL\.COM$/;
    var p2=/^[A-Za-z0-9._%+-]+@stspl\.com$/;
    if (!((p1).test(mail) || (p2).test(mail))){
      document.getElementById("msg").innerHTML="**INVALID EMAIL Please enter email like:a@stspl.com or A@STSPL\.COM"
      return false;
    
  }
    if (document.forms["signinform"]["password"].value.trim() == "") {
      document.getElementById("passworderror").style.visibility = "visible";
      return false;
    }
    
  }
</script>

</html>