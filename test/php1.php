<?php
    echo "Hello World";

    function add(int $a, int $b, int $c) {
        return $a+$b+$c;
    }
    echo add(1,2,3);

    function vote(int $age, string $firstname, string $lastname) {
        if ($age >= 18) {
            return $firstname . $lastname . "can vote";
        } else {
            return "$firstname $lastname cannot vote";
        }
    }
    echo vote(18, "Peter", "Parker");

    $numbers = array(2, 4, 6, 8, 10);
    array_push($numbers, 12);
    
    echo "position 0 has value" . $numbers[0];
  
    $fruits = array("a" => "orange", "b" => "banana", "c" => "apple");
    echo "My favorite fruit is " . $fruits["b"]

    // $name = "Peter";
    // if ($name == "Peter") {
    //   echo "Hello Peter";
    // }
    // else {
    //   echo "Not Peter";
    // }


?>