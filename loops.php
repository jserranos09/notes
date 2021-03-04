<?php
    // For and while loops

    //For loop  Params - inital($i = 0), condition($i <10), increment($1++)
    for($i = 0;$i <= 5;$i++){
        //prints 1-5
        echo 'Number ' . $i;
        echo '<br>';
    }

    // while loop Params - condition
    $i = 0;

    while($i < 5){
        echo $i;
        echo '<br>';
        $i++;
    }

    //foreach is meant to work with arrays
    $people = ['Brad', 'Jose', 'William']; 

    foreach($people as $person){
        echo $person;
        echo '<br>';
    }

    //foreach w/ associative array
    $people = ['Brad' => 'brad@gmail.com',
     'Jose' => 'jose@gmail.com',
    'William' => 'will@gmail.com']; 

    foreach($people as $person => $email){
        echo $person. ': ' . $email;
        echo '<br>';
    }

    //-------------------------------------------

    // Functions

    function simpleFunction(){
        echo 'Hello World';
    }
    simpleFunction();


    function sayHello($name){
        echo '<br>';
        echo  "Hello $name";
    }
    sayHello("Jeff");
    sayHello('bob');


    function sayHellos($name = 'Person'){
        echo '<br>';
        echo  "Hello $name";
        echo '<br>';
    }
    //will echo 'Hello Person' because no parameter
    sayHellos();


    //return and echo
    function addNumber($num1,$num2){
        echo $num1 + $num2;
        echo '<br>';
    } 
    addNumber(2,3);

    function addNumbers($num1,$num2){
        //wont print anything in browser
        return $num1 + $num2;
        echo '<br>';
    }
    echo addNumbers(3,3);
    echo '<br>';

    // a function by reference 
    $myNum = 10;

    function addFive($num){
        $num += 5;
    }
    //& changes the variable with the function
    function addTen(&$num){
        $num += 10;
    }

    addFive($myNum);
    echo "Value: $myNum<br>";

    addTen($myNum);
    echo "Value: $myNum<br>";
?>
