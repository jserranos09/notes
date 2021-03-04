<?php
    // variables
     
    $output = "Hello Worlds";
    $num1 = 4;
    $num2 = 10;
    $sum = $num1 + $num2;

    $string1 = 'Hello ';
    $string2 = "World <br>";

    // 2 ways to add strings together
    $greeting = $string1 . $string2;
    $greeting2 = "$string1 <br> $string2";
    // an escape sequence 
    $string3 = 'They\'re Here';
    // creates a constant. Something that doesnt get changed (like a server name)
    // define (name of constant (usual uppercase), what the constant is)
    define('GREETING', 'Hello Everyone');

    echo $greeting . "<br>";
    echo $greeting2;
    echo $sum . "<br>";
    echo $string3 . "<br>";
    echo GREETING;

   // --------------------------------------

    // indexed arrays
     $people = ['Kevin', 'Jeremy', 'sarah'];
     $id = [23, 55, 12];
     $cars = array('Honda', 'Toyota', 'Ford');
     $cars[3] = 'Chevy ';
     $cars[] = 'BMW';


    echo "<br>" . $people[1] . ' is ' . $id[2] . "<br>";
    echo $cars[3];
    echo $cars[4];
    //prints number in array (5)
    echo count($cars) . "<br>" . "<br>";
    //show the whole array
    print_r($cars);
    echo "<br>" . "<br>";
    //shows everything about the array
    var_dump($cars);


    // associative arrays
    $peoples = ['Brad' => 35, 'Jose' => 32, 'William' => 37];
    $ids = [22 => 'Brad', 44 => 'Jose', 63 => 'William'];
    $peoples['Jill'] = 42;

    echo "<br>" . "<br>";
    echo $peoples['Brad'];
    echo "<br>";
    echo $ids[44];
    echo "<br>";
    echo $peoples['Jill'];
    echo "<br>";
    var_dump($peoples);

    //muliti-dimensional array

    $moreCars = [
        ['Honda', 20, 10], ['toyota', 30, 20], ['Honda', 23, 12]
    ];
    echo "<br>";
    // prints toyota
    echo $moreCars[1][0];
?>
