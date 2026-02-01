<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="https://www.svgrepo.com/show/216266/manager-occupation.svg" />

</head>

<body>



    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student_manager_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connect thất bại: " . $conn->connect_error);
    }

    $sql = "SELECT id, name, mssv, age, birthday, phone, email, address, gender, description FROM students";
    $result = $conn->query($sql);
    ?>

    <div class="table-wrapper">
        <h1>Quản lý sinh viên</h1>
        <a href="create.php" class="btn btn-add">+ Thêm sinh viên</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>MSSV</th>
                <th>Tuổi</th>
                <th>Ngày sinh</th>
                <th>SĐT</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Giới tính</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    // format ngày sinh
                    $birthday = "";
                    if (!empty($row["birthday"])) {
                        $format = date_create($row["birthday"]);
                        $birthday = date_format($format, "d/m/Y");
                    }
            ?>
                    <tr>
                        <td><?= $row["id"] ?></td>
                        <td><?= htmlspecialchars($row["name"]) ?></td>
                        <td><?= htmlspecialchars($row["mssv"]) ?></td>
                        <td><?= $row["age"] ?></td>
                        <td><?= $birthday ?></td>
                        <td><?= htmlspecialchars($row["phone"]) ?></td>
                        <td><?= htmlspecialchars($row["email"]) ?></td>
                        <td><?= htmlspecialchars($row["address"]) ?></td>
                        <td><?= htmlspecialchars($row["gender"]) ?></td>
                        <td><?= htmlspecialchars($row["description"]) ?></td>
                        <td class="action-btns">
                            <a href="update_form.php?id=<?= $row["id"] ?>" class="btn btn-edit">Sửa</a>
                            <a href="delete.php?id=<?= $row["id"] ?>" class="btn btn-delete"
                                onclick="return confirm('Bạn có chắc muốn xóa sinh viên này không?')">
                                Xóa
                            </a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='11'>Chưa có sinh viên nào</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>
</body>

</html>