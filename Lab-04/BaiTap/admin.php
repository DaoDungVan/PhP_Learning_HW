<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin - Danh sách sinh viên</title>
</head>
<body>

<h2>Danh sách sinh viên đã đăng ký</h2>
<hr>

<?php
$filename = "thongtinsinhvien.txt";

if (!file_exists($filename)) {
    echo "Chưa có sinh viên nào đăng ký.";
    exit;
}

$myfile = fopen($filename, "r");

while (!feof($myfile)) {
    echo nl2br(fgets($myfile));
}

fclose($myfile);
?>

</body>
</html>
