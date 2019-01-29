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
if($_GET['mode']=='updateready') {
    $Qry="SELECT content FROM guestbook WHERE id=$_GET[id]";
    $rs=$conn->query($Qry);
    $row=$rs->fetch_array();
}
if($_GET['mode']=='update') {
    $Qry="UPDATE guestbook SET content='$_POST[content]', wdate=now() WHERE id=$_GET[id]";
    $rs=$conn->query($Qry);
    echo "<script>alert('글 수정 완료')</script>";
    echo "<script>location.href='main.php';</script>";
}
?>
<form method="post" action="update.php?id=<?=$_GET['id']?>&mode=update">
    <table width=600 border=1>
        <tr>
          <td><textarea placeholder="내용을 입력하세요." name="content" rows="8" cols="80"><?php echo $row['content']?></textarea></td>
        </tr>
        <tr>
          <td align=right><input type="submit" value="수정하기"/></td>
        </tr>
    </table>
</form>
</body>
</html>
