<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <?php
    function is_str_lowercase($str1)
    {
        $sc = 0;
        while ($sc < strlen($str1)) {

            // Check if character is uppercase
            if (ord($str1[$sc]) >= ord('A') && ord($str1[$sc]) <= ord('Z')) {
                return false;
            }

            $sc++;
        }return true;
    }

    $string = "Hello";
    $result = is_str_lowercase($string);
    echo "The word is : $string<br>";
    echo "Is the word is all lowercase: ";
    echo $result ? "true" : "false";
    ?>
</body>

</html>