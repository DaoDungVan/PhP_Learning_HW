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
    $dbname = "shop_web_25";

    // Create connection (CÓ DB)
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Select data
    $sql = "SELECT id, name, price, description, image_url FROM products";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imagePath = $row['image_url'];
            echo "ID: {$row['id']} - Name: {$row['name']} - Price: {$row['price']} - Description: {$row['description']}<br>";
            echo '<img src="' . $imagePath . '" width="150"><br><br>';
        }
    } else {
        echo "No results or query error";
    }

    $conn->close();
    ?>
</body>

</html>