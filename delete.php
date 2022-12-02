<?php
include "dbconn.php";
if(isset($_GET['deleteuser'])){
    $id = $_GET['deleteuser'];
    $sql    = "DELETE FROM intern WHERE `uid`='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result==TRUE) {
        $sql2= "DELETE FROM `internlang` WHERE `internid`='$id'";
        $result2 = mysqli_query($conn, $sql2);
        if($result2==TRUE){
            echo "<script>
                        alert('Record Deleted Successfully..!');
                        window.location.href='new.php';
                        </script>";
        }
        
    }
    else{
        die(mysqli_error($conn));
    }
}
