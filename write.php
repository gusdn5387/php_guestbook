<?php
$conn = mysqli_connect("localhost:3307", "root", 1234567);
mysqli_select_db($conn, "php_guestbook");

$Qry = "INSERT INTO guestbook (name,pass,content) VALUES('$_POST[name]','$_POST[pass]','$_POST[content]')";
$conn->query($Qry);

echo "<script>alert('글 작성 완료'); history.go(-1);</script>";
?>