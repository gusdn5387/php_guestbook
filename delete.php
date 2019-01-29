<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>php_guestbook</title>
</head>
<body>
<?php
$conn = mysqli_connect("localhost:3307", "root", 1234567);
mysqli_select_db($conn, "php_guestbook");
if($_GET['mode']!='delete') {
?>
<form method="post" action="delete.php?id=<?=$_GET['id']?>&mode=delete">
    <table border=1>
        <tr>
          <td>비밀 번호</td>
          <td><input type="password" name="pass"/></td>
          <td><input type="submit" value="확인"/></td>
        </tr>
    </table>
</form>
</body>
</html>
<?php
exit;
}
$Qry = "SELECT pass FROM guestbook WHERE id='$_GET[id]'";
$rs = $conn->query($Qry);
$row = $rs->fetch_array();
if($row[pass] == $_POST[pass]) {
    $Qry = "DELETE FROM guestbook WHERE id=$_GET[id]";
    $rs = $conn->query($Qry);
    echo "<script>alert('글 삭제 완료'); location.href='main.php';</script>";
} else {
    echo "<script>alert('비밀번호가 틀렸습니다.'); location.href='main.php';</script>";
}
?>