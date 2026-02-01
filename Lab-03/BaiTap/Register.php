<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <?php
    $nameErr = $phoneErr = $emailErr = $ageErr = $dayofBirthErr = $genderErr = $addressErr = $TrgCap3Err = $fatherNameErr = $motherNameErr = "";
    $name = $phone = $email = $age = $dayofBirth = $gender = $address = $TrgCap3 = $fatherName = $motherName = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Tên
        if (empty($_POST["name"])) {
            $nameErr = "Không được bỏ trống";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-ZÀ-ỹ\s]+$/u", $name)) {
                $nameErr = "Chỉ được nhập chữ";
            }
        }

        //Sđt
        if (empty($_POST["phone"])) {
            $phoneErr = "Không được bỏ trống";
        } else {
            $phone = test_input($_POST["phone"]);
            if (!preg_match("/^[0-9]{9,11}$/", $phone)) {
                $phoneErr = "SĐT phải từ 9–11 chữ số";
            }
        }

        //email
        if (empty($_POST["email"])) {
            $emailErr = "Không được bỏ trống";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Email không hợp lệ";
            }
        }

        //tuổi
        if (empty($_POST["age"])) {
            $ageErr = "Không được bỏ trống";
        } else {
            $age = test_input($_POST["age"]);
            if ($age < 18) {
                $ageErr = "Sinh viên phải từ 18 tuổi trở lên";
            }
        }

        //ngày tháng năm sinh
        if (empty($_POST["birthday"])) {
            $dayofBirthErr = "Không được bỏ trống";
        } else {
            $dayofBirth = test_input($_POST["birthday"]);
            $today = new DateTime();
            $birthDate = new DateTime($dayofBirth);
            $ageCalculated = $today->diff($birthDate)->y;

            if ($birthDate > $today) {
                $dayofBirthErr = "Ngày sinh không hợp lệ";
            } elseif ($ageCalculated < 18) {
                $dayofBirthErr = "Sinh viên phải từ 18 tuổi trở lên";
            }
        }

        //giới tính
        if (empty($_POST["gender"])) {
            $genderErr = "Không được bỏ trống";
        } else {
            $gender = test_input($_POST["gender"]);
        }

        //địa chỉ
        if (empty($_POST["address"])) {
            $addressErr = "Không được bỏ trống";
        } else {
            $address = test_input($_POST["address"]);
        }

        //trg cap 3
        if (empty($_POST["school"])) {
            $TrgCap3Err = "Không được bỏ trống";
        } else {
            $TrgCap3 = test_input($_POST["school"]);
        }

        //ten cha
        if (empty($_POST["fatherName"])) {
            $fatherNameErr = "Không được bỏ trống";
        } else {
            $fatherName = test_input($_POST["fatherName"]);
        }

        //ten me
        if (empty($_POST["motherName"])) {
            $motherNameErr = "Không được bỏ trống";
        } else {
            $motherName = test_input($_POST["motherName"]);
        }

        if (
            $nameErr == "" && $phoneErr == "" && $emailErr == "" && $ageErr == "" && $dayofBirthErr == "" && $genderErr == "" && $addressErr == ""
            && $TrgCap3Err == "" && $fatherNameErr == "" && $motherNameErr == ""
        ) {
            include "welcome.php";
            exit;
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <h3>Form đăng ký sinh viên</h3>
    <p><span class="error">Dấu * là bắt buộc điền</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Họ và tên:
        <input type="text" name="name">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>
        SĐT:
        <input type="text" name="phone">
        <span class="error">* <?php echo $phoneErr; ?></span>
        <br><br>
        Email:
        <input type="text" name="email">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br><br>
        Tuổi:
        <input type="number" name="age">
        <span class="error">* <?php echo $ageErr; ?></span>
        <br><br>
        Ngày tháng năm sinh:
        <input type="date" name="birthday">
        <span class="error">* <?php echo $dayofBirthErr; ?></span>
        <br><br>
        <div class="gender-group">
            Giới tính:
            <input type="radio" name="gender" value="Nam"> Nam
            <input type="radio" name="gender" value="Nữ"> Nữ
            <input type="radio" name="gender" value="Khác"> Khác
            <br>
            <span class="error"><?php echo $genderErr; ?></span>
        </div><br>
        Địa chỉ:
        <input type="text" name="address">
        <span class="error">* <?php echo $addressErr; ?></span>
        <br><br>
        Trường cấp 3:
        <input type="text" name="school">
        <span class="error">* <?php echo $TrgCap3Err; ?></span>
        <br><br>
        Họ tên Cha:
        <input type="text" name="fatherName">
        <span class="error">* <?php echo $fatherNameErr; ?></span>
        <br><br>
        Họ tên Mẹ:
        <input type="text" name="motherName">
        <span class="error">* <?php echo $motherNameErr; ?></span>
        <br><br>
        <input type="submit" name="submit" value="Gửi đăng ký">
    </form>
</body>

</html>