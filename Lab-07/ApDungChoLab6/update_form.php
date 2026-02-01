<?php
// ===== CONNECT DATABASE =====
$conn = new mysqli("localhost", "root", "", "student_manager_db");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// ===== KHAI BÁO BIẾN =====
$idErr = $nameErr = $mssvErr = $ageErr = $birthdayErr = $phoneErr = $emailErr = $addressErr = $genderErr = "";
$id = $name = $mssv = $age = $birthday = $phone = $email = $address = $gender = $description = "";

// ===== HÀM LÀM SẠCH DỮ LIỆU (CHỈ DÙNG CHO HIỂN THỊ / VALIDATE) =====
function test_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// ===== LẤY DỮ LIỆU THEO ID (KHI VÀO TRANG UPDATE) =====
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "SELECT * FROM students WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $mssv = $row["mssv"];
        $age = $row["age"];
        $birthday = $row["birthday"];
        $phone = $row["phone"];
        $email = $row["email"];
        $address = $row["address"];
        $gender = $row["gender"];
        $description = $row["description"];
    } else {
        echo "Không tìm thấy sinh viên!";
        exit;
    }
}

// ===== XỬ LÝ KHI SUBMIT FORM =====
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"]; // lấy id từ hidden input

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


    // ===== KIỂM TRA TRÙNG MSSV (TRỪ CHÍNH NÓ) =====
    if ($mssvErr == "") {
        $stmt = $conn->prepare("SELECT id FROM students WHERE mssv = ? AND id != ?");
        $stmt->bind_param("si", $mssv, $id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $mssvErr = "MSSV đã tồn tại";
        }
        $stmt->close();
    }

    // ===== KIỂM TRA TRÙNG SĐT =====
    if ($phoneErr == "") {
        $stmt = $conn->prepare("SELECT id FROM students WHERE phone = ? AND id != ?");
        $stmt->bind_param("si", $phone, $id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $phoneErr = "Số điện thoại đã tồn tại";
        }
        $stmt->close();
    }

    // ===== KIỂM TRA TRÙNG EMAIL =====
    if ($emailErr == "") {
        $stmt = $conn->prepare("SELECT id FROM students WHERE email = ? AND id != ?");
        $stmt->bind_param("si", $email, $id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $emailErr = "Email đã tồn tại";
        }
        $stmt->close();
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

    // ===== NẾU KHÔNG CÓ LỖI -> UPDATE DB =====
    if (
        $nameErr == "" && $mssvErr == "" && $ageErr == "" &&
        $birthdayErr == "" && $phoneErr == "" && $emailErr == "" &&
        $addressErr == "" && $genderErr == ""
    ) {
        $sql = "UPDATE students SET 
                    name='$name',
                    mssv='$mssv',
                    age='$age',
                    birthday='$birthday',
                    phone='$phone',
                    email='$email',
                    address='$address',
                    gender='$gender',
                    description='$description'
                WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit;
        } else {
            echo "<p style='color:red'>Lỗi: " . $conn->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cập nhật sinh viên</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="https://www.svgrepo.com/show/216266/manager-occupation.svg" />
    <style>
        span.error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Cập nhật sinh viên</h1>

        <form action="" method="post">

            <!-- ID ẨN (KHÔNG CHO SỬA) -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">

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
            <button type="submit">Cập nhật</button>
        </form>

    </div>


</body>

</html>