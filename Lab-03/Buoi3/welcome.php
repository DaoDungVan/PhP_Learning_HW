<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chào mừng sinh viên</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 30px;
        }

        .container {
            width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 10px;
            font-size: 15px;
        }

        .info span {
            font-weight: bold;
            color: #333;
        }

        hr {
            margin: 20px 0;
        }

        .success {
            text-align: center;
            color: green;
            font-weight: bold;
            margin-top: 15px;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <h3>🎓 Chào mừng sinh viên mới</h3>

        <div class="info"><span>Họ và tên:</span> <?php echo $_POST["name"]; ?></div>
        <div class="info"><span>SĐT:</span> <?php echo $_POST["phone"]; ?></div>
        <div class="info"><span>Email:</span> <?php echo $_POST["email"]; ?></div>
        <div class="info"><span>Tuổi:</span> <?php echo $_POST["age"]; ?></div>
        <div class="info"><span>Ngày sinh:</span> <?php echo $_POST["birthday"]; ?></div>
        <div class="info"><span>Giới tính:</span> <?php echo $_POST["gender"]; ?></div>
        <div class="info"><span>Địa chỉ:</span> <?php echo $_POST["address"]; ?></div>
        <div class="info"><span>Trường cấp 3:</span> <?php echo $_POST["school"]; ?></div>
        <div class="info"><span>Họ tên Cha:</span> <?php echo $_POST["fatherName"]; ?></div>
        <div class="info"><span>Họ tên Mẹ:</span> <?php echo $_POST["motherName"]; ?></div>

        <hr>

        <?php
        $myfile = fopen("thongtinsinhvien.txt", "a") or die("Không thể mở file!");

        $txt =
            "Họ tên: " . $_POST["name"] . "\n" .
            "SĐT: " . $_POST["phone"] . "\n" .
            "Email: " . $_POST["email"] . "\n" .
            "Tuổi: " . $_POST["age"] . "\n" .
            "Ngày sinh: " . $_POST["birthday"] . "\n" .
            "Giới tính: " . $_POST["gender"] . "\n" .
            "Địa chỉ: " . $_POST["address"] . "\n" .
            "Trường cấp 3: " . $_POST["school"] . "\n" .
            "Họ tên Cha: " . $_POST["fatherName"] . "\n" .
            "Họ tên Mẹ: " . $_POST["motherName"] . "\n" .
            "--------------------------\n";

        fwrite($myfile, $txt);
        fclose($myfile);
        ?>

        <div class="success">Thông tin đã được lưu thành công</div>
        <a href="Register.php" class="btn">Quay lại đăng ký</a>
    </div>

</body>

</html>