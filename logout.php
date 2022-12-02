<?php
session_start();
session_destroy();
echo "<script>
alert('Logout Successfully..!');
window.location.href='signin.php';
</script>";
?>