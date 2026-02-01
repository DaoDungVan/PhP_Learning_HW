<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="https://www.svgrepo.com/show/216266/manager-occupation.svg"/>
    <style>
        span.error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <?php
    // ===== CONNECT DATABASE =====
    $conn = new mysqli("localhost", "root", "", "student_manager_db");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // ===== KHAI BÁO BIẾN =====
    $idErr = $nameErr = $mssvErr = $ageErr = $birthdayErr = $phoneErr = $emailErr = $addressErr = $genderErr = "";
    $id = $name = $mssv = $age = $birthday = $phone = $email = $address = $gender = $description = "";

    function test_input($data)
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // ===== ID (không bắt buộc vì auto increment) =====
        // if (!empty($_POST["id"])) {
        //     $id = test_input($_POST["id"]);

        //     // kiểm tra trùng ID trong DB
        //     $checkId = $conn->query("SELECT id FROM students WHERE id = '$id'");
        //     if ($checkId->num_rows > 0) {
        //         $idErr = "ID đã tồn tại trong hệ thống";
        //     }
        // }

        // ===== TÊN =====
        if (empty($_POST["name"])) {
            $nameErr = "Không được bỏ trống tên";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-ZÀ-ỹ\s]+$/u", $name)) {
                $nameErr = "Tên chỉ được chứa chữ cái";
            }
        }

        // ===== MSSV =====
        if (empty($_POST["mssv"])) {
            $mssvErr = "Không được bỏ trống MSSV";
        } else {
            $mssv = test_input($_POST["mssv"]);
        }

        // ===== TUỔI =====
        if (empty($_POST["age"])) {
            $ageErr = "Không được bỏ trống tuổi";
        } else {
            $age = test_input($_POST["age"]);
            if ($age < 18) {
                $ageErr = "Sinh viên phải từ 18 tuổi trở lên";
            }
        }

        // ===== NGÀY SINH =====
        if (empty($_POST["birthday"])) {
            $birthdayErr = "Không được bỏ trống ngày sinh";
        } else {
            $birthday = test_input($_POST["birthday"]);
            $today = new DateTime();
            $birthDate = new DateTime($birthday);
            $ageCalculated = $today->diff($birthDate)->y;

            if ($birthDate > $today) {
                $birthdayErr = "Ngày sinh không hợp lệ";
            } elseif ($ageCalculated < 18) {
                $birthdayErr = "Sinh viên phải từ 18 tuổi trở lên";
            }
        }

        // ===== SĐT =====
        if (empty($_POST["phone"])) {
            $phoneErr = "Không được bỏ trống SĐT";
        } else {
            $phone = test_input($_POST["phone"]);
            if (!preg_match("/^[0-9]{9,11}$/", $phone)) {
                $phoneErr = "SĐT phải từ 9 đến 11 chữ số";
            }
        }

        // ===== EMAIL =====
        if (empty($_POST["email"])) {
            $emailErr = "Không được bỏ trống email";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Email không hợp lệ";
            }
        }

        // ===== ĐỊA CHỈ =====
        if (empty($_POST["address"])) {
            $addressErr = "Không được bỏ trống địa chỉ";
        } else {
            $address = test_input($_POST["address"]);
        }

        // ===== GIỚI TÍNH =====
        if (empty($_POST["gender"])) {
            $genderErr = "Vui lòng chọn giới tính";
        } else {
            $gender = test_input($_POST["gender"]);
        }

        // ===== MÔ TẢ =====
        if (!empty($_POST["description"])) {
            $description = test_input($_POST["description"]);
        }

        // ===== NẾU KHÔNG CÓ LỖI -> INSERT DB =====
        if (
            $idErr == "" && $nameErr == "" && $mssvErr == "" && $ageErr == "" &&
            $birthdayErr == "" && $phoneErr == "" && $emailErr == "" &&
            $addressErr == "" && $genderErr == ""
        ) {

            if ($id == "") {
                $sql = "INSERT INTO students (name, mssv, age, birthday, phone, email, address, gender, description)
                    VALUES ('$name', '$mssv', '$age', '$birthday', '$phone', '$email', '$address', '$gender', '$description')";
            } else {
                $sql = "INSERT INTO students (id, name, mssv, age, birthday, phone, email, address, gender, description)
                    VALUES ('$id', '$name', '$mssv', '$age', '$birthday', '$phone', '$email', '$address', '$gender', '$description')";
            }

            if ($conn->query($sql) === TRUE) {
                header("Location: index.php");
                exit;
            } else {
                echo "<p style='color:red'>Lỗi: " . $conn->error . "</p>";
            }
        }
    }
    ?>

    <div class="container">
        <h1>Thêm sinh viên</h1>

        <form action="" method="post">

            <label>Tên:</label>
            <input type="text" name="name" value="<?php echo $name; ?>">
            <span class="error"><?php echo $nameErr; ?></span>

            <label>MSSV:</label>
            <input type="text" name="mssv" value="<?php echo $mssv; ?>">
            <span class="error"><?php echo $mssvErr; ?></span>

            <label>Tuổi:</label>
            <input type="number" name="age" value="<?php echo $age; ?>">
            <span class="error"><?php echo $ageErr; ?></span>

            <label>Ngày sinh:</label>
            <input type="date" name="birthday" value="<?php echo $birthday; ?>">
            <span class="error"><?php echo $birthdayErr; ?></span>

            <label>SĐT:</label>
            <input type="text" name="phone" value="<?php echo $phone; ?>">
            <span class="error"><?php echo $phoneErr; ?></span>

            <label>Email:</label>
            <input type="text" name="email" value="<?php echo $email; ?>">
            <span class="error"><?php echo $emailErr; ?></span>

            <label>Địa chỉ:</label>
            <input type="text" name="address" value="<?php echo $address; ?>">
            <span class="error"><?php echo $addressErr; ?></span>

            <label>Giới tính:</label>
            <div class="radio-group">
                <input type="radio" name="gender" value="Nam" <?php if ($gender == "Nam") echo "checked"; ?>> Nam
                <input type="radio" name="gender" value="Nữ" <?php if ($gender == "Nữ") echo "checked"; ?>> Nữ
                <input type="radio" name="gender" value="Khác" <?php if ($gender == "Khác") echo "checked"; ?>> Khác
            </div>
            <span class="error"><?php echo $genderErr; ?></span>

            <label>Mô tả:</label>
            <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>

            <br>
            <a href="index.php" class="btn btn-edit">← Quay về</a>
            <button type="submit">Thêm sinh viên</button>
        </form>
    </div>


</body>

</html>