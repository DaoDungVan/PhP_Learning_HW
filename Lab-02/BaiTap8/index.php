<!DOCTYPE html>
<html>
<head>
    
</head>
<body>
    <?php
        function check_palindrome($string){
            if($string ==   strrev($string)) return 1;
            else return 0;
        }
        
        $test1 = "madam";
        $test2 = "television";

        echo "$test1: ".check_palindrome($test1)."<br>";
        echo "$test2: ".check_palindrome($test2);
    ?>
</body>
</html>