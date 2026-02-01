<!DOCTYPE html>
<html>
<body>

<?php
class Fruit {
  public $name;
  public $color;

  function __construct($name, $color) {
    $this->name = $name; 
    $this->color = $color; 
  }
  
  function __destruct(){}
  
  function ___construct($name){$this->name = $name;}
  
  function ____construct($color){$this->color = $color;}
  
  function get_name() {
    return $this->name;
  }
  function get_color() {
    return $this->color;
  }
}

$apple = new Fruit("Apple", "red");
echo $apple->get_name();
echo "<br>";
echo $apple->get_color();

$apple1 = new Fruit("","");
echo $apple1->get_name();
echo "<br>";
echo $apple1->get_color();
?>
 
</body>
</html>