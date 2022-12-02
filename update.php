<?php
include "dbconn.php";
// echo '2';
$id = $_GET['updateuser'];
if (isset($_POST['update'])  && isset($_FILES['file'])) {
  // echo "<pre>";
  // print_r($_POST);
  // echo "</pre>";
  // exit;
  // $id = $_GET['updateuser'];
  $username = $_POST['name'];
  $usermail = $_POST['mail'];
  $address = $_POST['address'];
  $period = $_POST['period'];

  $file_name = $_FILES['file']['name'];
  $file_size = $_FILES['file']['size'];
  $file_tmp = $_FILES['file']['tmp_name'];
  $file_type = $_FILES['file']['type'];
  if (move_uploaded_file($file_tmp, "cv/$file_name")) {


    $sql = "UPDATE `intern` SET `uname`='$username',`umail`='$usermail',`uaddress`='$address',`uperiod`='$period',`updf`='$file_name' WHERE uid='$id'";

    //  echo $sql;
    //  exit;
    $result = mysqli_query($conn, $sql);
    if ($result) {

      echo "<script>
                          alert('Updated Successfully..!');
                          window.location.href='new.php';
                          </script>";
    } else {
      echo '<script>alert("Check Your Data ")</script>';
    }
  }
}
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

  <title>UPDATE</title>
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

    form i {
      float: right;
      cursor: pointer;
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
  <a class="nav-link"  href="https://www.stspl.com/"><img src="lg.jpg"></a>
    <h1>INTERNSHIP PORTAL</h1>
  </div>

  <?php
  // echo '1';
  $id = $_GET['updateuser'];
  $sql    = "select * from intern where uid=$id";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  // echo "<pre>";
  // print_r($row);
  // echo "</pre>";
  // exit;


  ?>
  <br><br><br>

  <h1 class="text-center">Update</h1>
  <form name="updateform" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
    <div class="form-group col-md-6">


      <div>
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" autocomplete="off" value="<?php echo $row['uname']; ?>">
       <b> <label id="nameerror" style="visibility:hidden; color:red; ">This Field Is Requierd</label></b>
      </div>

      <div><label for="name">Email</label>
        <input type="text" class="form-control" id="mail" name="mail" placeholder="Enter your mail" autocomplete="off" value="<?php echo $row['umail']; ?>">
        <b><label id="mailerror" style="visibility:hidden; color:red; ">This Field Is Requierd</label></b>
        <b><label id="msg"  style="color:red; "></label></b>
      </div>

      <div>
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" disabled value="<?php echo $row['upassword']; ?>">
        <i class="far fa-eye" id="togglePassword" style="float: left; cursor: pointer; margin-top:6px;"></i>
        
      </div>



      <div>
        <label for="mail">Address</label>
        <textarea class="form-control" id="address" name="address" autocomplete="off"> <?php echo $row['uaddress']; ?> </textarea>
        <b><label id="addresserror" style="visibility:hidden; color:red; ">This Field Is Requierd</label></b>
      </div>

      <div>
        <label for="type"> Select Internship Period </label>
        <select class="form-control" id="period" name="period">
          <option value="">--Select--</option>
          <?php
          $psql = "SELECT * FROM `month`";
          $result = mysqli_query($conn, $psql);
          if (mysqli_num_rows($result) > 0) {
            foreach ($result as $prow) {
          ?>
              <option value="<?php echo $prow['mid']; ?>" <?php if ($row['uperiod'] == $prow['mid']) {
                                                            echo $prow['period'] ? 'selected' : '';
                                                          } ?>> <?php echo $prow['period']; ?> </option>
            <?php
            }
          } else {
            ?>
            <option>No Record Found</option>
          <?php
          }
          ?>
        </select>
        <b><label id="montherror" style="visibility:hidden; color:red; ">Requierd field</label></b>
      </div>

      <div>
        <label for="type"> Select Language </label>
        <?PHP
        if (isset($_GET['updateuser'])) {
          $id = $_GET['updateuser'];
          $lsql1 = "SELECT internlang.*,language.* 
                    FROM `internlang`,`language` 
                    WHERE  internlang.lid = language.langid && internlang.internid= $id";
          $result1 = mysqli_query($conn, $lsql1);

          $arr = [];
          foreach ($result1 as $lrow) {
            $arr[] = $lrow['langid'];
          }
        }
        ?>
        <select class="form-control" id="lang" name="lang[]" multiple disabled>
          <?php
          $lsql = "SELECT * FROM `language`";
          $result = mysqli_query($conn, $lsql);
          if (mysqli_num_rows($result) > 0) {
            foreach ($result as $lrow) {
             
          ?>
          
              <option value="<?php echo $lrow['langid']; ?>" <?php echo in_array($lrow['langid'], $arr) ? ' selected' : '' ?>> <?php echo $lrow['lang']; ?> </option>
            <?php
            }
          } else {
            ?>
            <option>No Record Found</option>
          <?php
          }
          ?>
        </select>
      </div>


      <div>
        <input type="file" id="file" name="file" placeholder="upload cv " class="btn btn-secondary">
        <b><label id="fileerror" style="visibility:hidden; color:red; ">Upload cv</label></b>
      </div>
    </div>



    <button type="submit" name="update" class="btn btn-primary">Update</button>
  </form>

  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', () => {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.classList.toggle('fa-eye');
    });
  </script>

</body>
<script>
  function validateForm() {

    if (document.forms["updateform"]["name"].value.trim() == "") {
      document.getElementById("nameerror").style.visibility = "visible";
      return false;
    }

    if (document.forms["updateform"]["mail"].value.trim() == "") {
      document.getElementById("mailerror").style.visibility = "visible";
      return false;
    }

    var mail =document.updateform.mail.value;
    var p1=/^[A-Za-z0-9._%+-]+@STSPL\.COM$/;
    var p2=/^[A-Za-z0-9._%+-]+@stspl\.com$/;
    if (!((p1).test(mail) || (p2).test(mail))){
      document.getElementById("msg").innerHTML="**INVALID EMAIL Please enter email like:a@stspl.com or A@STSPL\.COM"
      return false;
    }

    if (document.forms["updateform"]["address"].value.trim() == "") {
      document.getElementById("addresserror").style.visibility = "visible";
      return false;
    }

    if (document.forms["updateform"]["period"].value.trim() == "") {
      document.getElementById("montherror").style.visibility = "visible";
      return false;
    }

    if (document.forms["updateform"]["file"].value.trim() == "") {
      document.getElementById("fileerror").style.visibility = "visible";
      return false;
    }

  }
</script>

</html>