<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button-gender {
            background-color: #2196F3;
            border: none;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            margin: 4px 2px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <h1>Student management application</h1>
    <a href="form.php">Add New Student</a>
    <br><br>

    Bộ lọc:
    Giới tính
    <a class="button-gender" href="index.php?gender=1">Nam</a>
    <a class="button-gender" href="index.php?gender=2">Nữ</a>
    <a class=" button-gender" href="index.php?gender=3">Khác</a>
    <br><br>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student_management_db_25";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $limit = 10;
    $page = $_GET['page'] ?? 1;
    $offset = ($page - 1) * $limit;
    // Undefined array key gender
    // $gender = $_GET['gender'];
    $gender = $_GET['gender'] ?? null;
    // code bị gắn cứng
    // $keyword = "Thị";
    $keyword = $_GET['keyword'] ?? "";

    // $sql = "SELECT id, name, gender FROM students limit $limit offset $offset";


    //%Thị%
    // if ($gender) {
    //     $sql = "SELECT id, name, gender FROM students WHERE gender = $gender and name LIKE '%$keyword%' limit $limit offset $offset";
    // }

    if ($gender !== null) {

        $stmt = $conn->prepare(
            "SELECT id, name, gender 
         FROM students 
         WHERE gender = ? 
         AND name LIKE ?
         LIMIT ? OFFSET ?"
        );

        $search = "%$keyword%";
        $stmt->bind_param("isii", $gender, $search, $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {

        $stmt = $conn->prepare(
            "SELECT id, name, gender 
         FROM students 
         LIMIT ? OFFSET ?"
        );
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . " - Name: " . $row["name"] . " - Gender: " . $row["gender"] . " <a href='edit.php?id=" . $row["id"] . "&name=" . $row["name"] . "'>Edit</a><br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>

    <div class="pagination">
        <!-- <a class="button" href="index.php?page=1">1</a>
        <a class="button" href="index.php?page=2">2</a>
        <a class=" button" href="index.php?page=3">3</a> -->
        <a class="button" href="index.php?page=1&gender=<?= $gender ?>&keyword=<?= $keyword ?>">1</a>
        <a class="button" href="index.php?page=2&gender=<?= $gender ?>&keyword=<?= $keyword ?>">2</a>
        <a class="button" href="index.php?page=3&gender=<?= $gender ?>&keyword=<?= $keyword ?>">3</a>
    </div>
</body>

</html>