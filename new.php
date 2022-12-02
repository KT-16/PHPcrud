<?php
include "dbconn.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <style>
        table {
            border-spacing: 15px;
            border: 1px solid;
            border-collapse: collapse;
            width: 1000px;
            display: block;
        }

        th,
        td {
            padding: 13px;
        }
    </style>
</head>

<body>
    <div class="topnav">
    <a class="nav-link"  href="https://www.stspl.com/"><img src="lg.jpg"></a>
        <h1>INTERNSHIP PORTAL</h1>
        <a class="nav-link" href="logout.php">Logout</a>
    </div>
    <br><br><br>
    <h1 style="text-align:center;margin-top:10px;">WELCOME</h1>
    <div class="container">

        <a href="add.php" class="text-light">
            <button type="submit" class="btn btn-dark" style="margin-bottom:10px;">Add</button>
        </a>


        <table class="table">
            <thead>
                <tr>
                    <th scope="col"> Name</th>
                    <th scope="col"> Mail</th>
                    <th scope="col">Password</th>
                    <th scope="col">Address</th>
                    <th scope="col">Period</th>
                    <th scope="col">Language</th>
                    <th scope="col">File uploaded</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php


                $sql    = "SELECT intern.*,month.*,internlang.*,language.*, 
                        GROUP_CONCAT(language.lang) AS langlist 
                        FROM `intern`,`month`,`internlang`,`language`
                        WHERE intern.uperiod=month.mid && internlang.lid=language.langid && intern.uid=internlang.internid
                        GROUP BY intern.uid 
                        ORDER BY `uname` ASC;";
                $result = mysqli_query($conn, $sql);
                // echo "<pre>";
                // print_r($sql);
                // echo "</pre>";
                // exit;
                if ($result) {


                    while ($row = mysqli_fetch_assoc($result)) {
                        // echo "<pre>";
                        // print_r($row);
                        // echo "</pre>";


                        $id = $row['uid'];
                        $name = $row['uname'];
                        $mail = $row['umail'];
                        $password = $row['upassword'];
                        $address =  $row['uaddress'];
                        $period =  $row['period'];
                        $lang =  $row['langlist'];
                        $pdf =  $row['updf'];
                        echo '<tr>
                
                            <td scope="row">' . $name . '</td>
                            <td>' . $mail . '</td>
                            <td>' . $password . '</td>
                            <td>' . $address . '</td>
                            <td>' . $period . '</td>
                            <td>' . $lang . '</td>
                            <td>' . $pdf . '</td>
                            <td>
                            <a href="update.php? updateuser=' . $id . '" class ="text-light">
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                            </a>
                            <a href="delete.php? deleteuser=' . $id . '" class ="text-light">    
                            <button type="submit" name="delete" class="btn btn-danger"> Delete</button>
                            </a>
                            </td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>