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
$Qry = "SELECT * FROM guestbook ORDER BY id DESC";
$rs = $conn->query($Qry) or die('DB 서버 오류');
$totalPage = mysqli_num_rows($rs);
$startPage = $_GET['startPage'];
if(!$startPage) $startPage=0;
$Qry = "SELECT * FROM guestbook ORDER BY id DESC limit $startPage, 5";
$rs = $conn->query($Qry);
?>
<center>
<form action="write.php" method="post">
    <table border=1 width=600> 
        <tr>
            <td><label>이름 : <input type="text" name="name"/></label></td>
            <td><label>비밀번호 : <input type="password" name="pass"/></label></td>
        </tr>
        <tr>
            <td colspan=4>
                <textarea plcaeholder="내용을 입력하세요." name="content" rows="8" cols="80"></textarea>
            </td>
        </tr>
        <tr>
            <td colspan=4 align=right><input type="submit" value="작성하기"/></td>
        </tr>
    </table>
</form>
<br/>
<?php
    while($row=$rs->fetch_array()) {
        echo "<table width=600 border=1> <tr>";
        echo "<td>$row[id]</td>";
        echo "<td>$row[name]</td>";
        echo "<td>$row[wdate]</td>";
        echo "<td><a href='updatecheck.php?id=$row[id]&mode=updatecheck'>수정</a></td>";
        echo "<td><a href='delete.php?id=$row[id]&mode=deletecheck'>삭제</a></td>";
        echo "<tr><td colspan=5>$row[content]</td></tr></table><br/>";
    }
    $pages = $totalPage / 5;
    for($i=0; $i<$pages; $i++) {
        $nextPage = $i * 5;
        $j = $i+1;
        echo "<a href=$_SERVER[PHP_SELF]?startPage=$nextPage>[$j]</a>";
    }
?>
</center>
</body>
</html>