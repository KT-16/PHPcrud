<?php
error_reporting(0);
$servername = "localhost";

$username = "root";

$password = "";

$dbname = "stsintern";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn == FALSE) {
    echo "not ok" . mysqli_connect_error();
}
