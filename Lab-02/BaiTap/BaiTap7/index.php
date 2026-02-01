<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <?php
    function array_not_unique($my_array)
    {
        $same = array();
        natcasesort($my_array);
        reset($my_array);
        $old_key = NULL;
        $old_value = NULL;

        foreach ($my_array as $key => $value) {
            if ($value === NULL) {
                $old_value = $value;
                $old_key = $key;
                continue;
            }

            if ($old_value === $value) {
                $same[$old_key] = $old_value;
                $same[$key]     = $value;
            }

            $old_value = $value;
            $old_key   = $key;
        }
        return $same;
    }
    $email = array(
        "test@gmail.com",
        "admin@yahoo.com",
        "Test@gmail.com",
        "user@hotmail.com",
        "admin@yahoo.com",
        "hello@gmail.com");
    $result = array_not_unique($email);

    echo "<h3>Các địa chỉ email bị trùng:</h3>";
    echo "<pre>";
    print_r($result);
    echo "</pre>";
    ?>
</body>

</html>