<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE students SET name='" . $_POST["name"] . "', mssv='" . $_POST["mssv"] . "',   
    age=" . $_POST["age"] . ", birthday='" . $_POST["birthday"] . "', phone='" . $_POST["phone"] . "',
    email='" . $_POST["email"] . "', address='" . $_POST["address"] . "', gender='" . $_POST["gender"] . "',
    description='" . $_POST["description"] . "' WHERE id=" . $_POST["id"];

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Sửa thất bại rồi bạn ơi: " . $conn->error;
    }

    $conn->close();
    ?>
</body>

</html>