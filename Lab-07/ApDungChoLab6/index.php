<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sinh viên</title>
    <link rel="stylesheet" href="./custom.css">
</head>

<body>

    <?php
    $conn = new mysqli("localhost", "root", "", "student_manager_db");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $keyword = $_GET['keyword'] ?? '';
    $gender  = $_GET['gender'] ?? '';
    $page    = $_GET['page'] ?? 1;

    $limit = 5;
    $page = max(1, (int)$page);
    $offset = ($page - 1) * $limit;

    $where = "WHERE 1=1";

    if ($keyword !== '') {
        $safeKeyword = $conn->real_escape_string($keyword);
        $where .= " AND (name LIKE '%$safeKeyword%' OR mssv LIKE '%$safeKeyword%')";
    }

    if ($gender !== '') {
        $safeGender = $conn->real_escape_string($gender);
        $where .= " AND gender = '$safeGender'";
    }

    $countResult = $conn->query("SELECT COUNT(*) AS total FROM students $where");
    $totalRow = $countResult->fetch_assoc();
    $totalRecords = $totalRow['total'];
    $totalPages = ceil($totalRecords / $limit);

    $sql = "SELECT * FROM students $where LIMIT $limit OFFSET $offset";
    $result = $conn->query($sql);
    ?>

    <div class="table-wrapper">
        <h1>Quản lý sinh viên</h1>

        <a href="create.php" class="btn btn-add">+ Thêm sinh viên</a>

        <form class="filter-bar" method="get">
            <input type="text" name="keyword" placeholder="Tìm theo tên hoặc MSSV"
                value="<?= htmlspecialchars($keyword) ?>">

            <select name="gender">
                <option value="">-- Tất cả giới tính --</option>
                <option value="Nam" <?= $gender == "Nam" ? "selected" : "" ?>>Nam</option>
                <option value="Nữ" <?= $gender == "Nữ" ? "selected" : "" ?>>Nữ</option>
                <option value="Khác" <?= $gender == "Khác" ? "selected" : "" ?>>Khác</option>
            </select>

            <button type="submit">Lọc</button>
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>MSSV</th>
                <th>Tuổi</th>
                <th>Giới tính</th>
                <th>SĐT</th>
                <th>Email</th>
                <th>Hành động</th>
            </tr>

            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['mssv']) ?></td>
                        <td><?= $row['age'] ?></td>
                        <td><?= htmlspecialchars($row['gender']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td class="action-btns">
                            <a href="update_form.php?id=<?= $row['id'] ?>" class="btn btn-edit">Sửa</a>
                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-delete"
                                onclick="return confirm('Bạn có chắc muốn xóa sinh viên này không?')">
                                Xóa
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align:center">Không có dữ liệu</td>
                </tr>
            <?php endif; ?>
        </table>
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a class="<?= ($i == $page) ? 'active' : '' ?>"
                    href="index.php?page=<?= $i ?>&keyword=<?= urlencode($keyword) ?>&gender=<?= $gender ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
    </div>

    <?php $conn->close(); ?>

</body>

</html>