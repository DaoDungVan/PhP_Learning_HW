<!DOCTYPE html>
<html>

<body>

    <?php
    class Fruit
    {
        // Properties
        public $name;
        // public $color;

        // Methods
        function set_name($name)
        {
            $this->name = $name;
        }
        function get_name()
        {
            return $this->name;
        }
    }

    // $apple = new Fruit();
    // $banana = new Fruit();
    // $mango = new Fruit();
    // $avocado = new Fruit();
    // $pineapple = new Fruit();
    // $orange = new Fruit();
    // $strawberry =  new Fruit();
    // $blueberry = new Fruit();
    // $kiwi = new Fruit();
    // $durian = new Fruit();
    $apple->set_name('Apple');
    $banana->set_name('Banana');
    $mango->set_name('Mango');
    $avocado->set_name('Avocado');
    $pineapple->set_name('Pineapple');
    $orange->set_name('Orange');
    $strawberry->set_name('strawberry');
    $blueberry->set_name('blueberry');
    $kiwi->set_name('Kiwi');
    $durian->set_name('Durian');

    echo $apple->get_name();
    echo "<br>";
    echo $banana->get_name();
    echo "<br>";
    echo $mango->get_name();
    echo "<br>";
    echo $avocado->get_name();
    echo "<br>";
    echo $pineapple->get_name();
    echo "<br>";
    echo $orange->get_name();
    echo "<br>";
    echo $strawberry->get_name();
    echo "<br>";
    echo $blueberry->get_name();
    echo "<br>";
    echo $kiwi->get_name();
    echo "<br>";
    echo $durian->get_name();
    ?>

</body>

</html>