<?php
    //Codition / switch (case) / date
    
    /*
        === : Checks the value and the data type
        == :  Equals to
        != :  Not equals to
        !== : Not I dentical 
    */

    $num = '5';  
    //True. Checks the value not the data type
    if($num == 5){
        echo "5 passed";
        echo '<br>';
    }
    //False. isnt the same data type
    if($num === 5){
        echo "5 passed";
    //Checks another value
    } elseif($num == 6) {
        echo '6 passed';
    } else {
        echo 'Did not pass';
        echo '<br>';
    }

    $num1 = 6;
    // multiple if statements within itself (not ideal)
    if($num1 > 4){
        if($num1 < 10){
            echo "$num1 passed";
            echo '<br>';
        } else {
            echo 'stuff';
        }
    }
    /*
        AND : &&
        OR  : ||
        XOR
    */
    $num2 = 7;

    // a better way to wrie above code
    if($num2 > 5 &&/*AND*/ $num2 < 10){
        echo "$num2 passed";
        echo '<br>';
    }
    // Only one of these has to be rue
    if($num2 > 6 ||/*OR*/ $num2 < 10){
        echo "$num2 passed";
        echo '<br>';
    }
    // only one can be true, not both
    //False because both are true
    if($num2 > 6 XOR $num2 < 10){
        echo "$num2 passed";
        echo '<br>';
    }
    // elseif statemetns 
    $i = 3;
    if ($i == 4) {
    echo 'It equals  4';
    } elseif ($i < 4) {
    echo 'Its less than 4';
    } elseif ($i > 4) {
    echo 'Its greater than 4';
    }
//----------------------------------
    $favColor = 'red';

    // checks for a 'case/scenario'
    switch($favColor){
        case 'red':
            echo 'Your favorite color is red';
            echo '<br>', '<br>';
            
            break;
        case 'blue':
            echo 'Your favorite color is blue';
            break;
        case 'green':
            echo 'Your favorite color is green';
            break;
        // if it doesnt equal to any then exectues default
        default:
            echo 'Your favorite color is something else';
    }

//------------------------------------------

    //Dates
    
    echo date('d' . '/');  //day
    echo date('m' . '/');  //month
    echo date('Y' . ': ');  //Year
    echo date('l');  //day of the week
    echo '<br>';

    echo date('Y/m-d');  

    echo '<br>';
    echo date('h');  //hour
    echo '<br>';
    echo date('i');  //min
    echo '<br>';
    echo date('s');  //seconds
    echo '<br>';
    echo date('a');  //am or pm
    echo '<br>';

    // defines time zone
    date_default_timezone_set('America/Los_Angeles');
    echo date('h:i:sa');
    echo '<br>';


    $timestamp = mktime(11, 12, 13, 7, 9, 1988);
    //echo $timestamp;
    echo date('m/d/Y h:i:sa', $timestamp);
    echo '<br>';

    // converts a sting into a date and/or time
    $timestamp2 = strtotime('7:00pm November 14 2020');
    $timestamp3 = strtotime('tomorrow');
    $timestamp4 = strtotime('next sunday');
    $timestamp5 = strtotime('+2 days');
    $timestamp6 = strtotime('+3 monthss');


    echo date('m/d/Y h:i:sa', $timestamp2);
    echo '<br>';
    echo date('m/d/Y h:i:sa', $timestamp3);
    echo '<br>';
    echo date('m/d/Y h:i:sa', $timestamp4);
    echo '<br>';
    echo date('m/d/Y h:i:sa', $timestamp5);
    echo '<br>';
    echo date('m/d/Y h:i:sa', $timestamp6);
    echo '<br>';
?>
