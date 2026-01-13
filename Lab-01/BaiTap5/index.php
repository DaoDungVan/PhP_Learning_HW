<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $txt1 = "This heading is in the center";
        $txt2 = "This is paragraph one and should be on top";
        $txt3 = "Hello"; $txt4 = "You delivered your assignment ontime.";
        $txt5 = "Thanks"; $txt6 = "Mahnaz"; 
        $txt7 = "This is paragraph two and should be at bottom";
        echo "<h1><center>$txt1</h1><br>"; 
        echo $txt2;
        echo "<hr>";
        echo "$txt3<br>
        $txt4<br>
        $txt5<br>
        $txt6";
        echo "<hr>";
        echo $txt7;
    ?>
</body>
</html>