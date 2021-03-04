<?php
//strings

// substr(string, where to start, where to finish) - returns a portion of a string.     
    $output = substr('Hello', 1, 3);
// prints 'ell'
    echo $output . '<br>';
    $output2 =  substr('Hello', -4);
// prints 'ello'
    echo $output2 . '<br>';



// strpos - gives the length of a string
    $output3 = strlen('Hello again');
// prints 11
    echo $output3 . '<br>';



// strpos(string, letter looking for) - shows what postion string is loaced in
    $output4 = strpos('Hello again', 'o');
    echo $output4 . '<br>';



// trim() - trims white space
    $text = 'Hello Person             ';
    var_dump($text);
    echo '<br>';
// trims the spaces. can be used for form input, etc.
    $trimmed = trim($text);
    var_dump($trimmed);
    echo '<br>';



// strtoupper - makes everything uppercase
    $output5 = strtoupper('Hello person');
    echo $output5 . '<br>';
//strtolower - makes everything lowercase



// ucwords() - Uppercase every word
    $output6 = ucwords('hello you person');
    echo $output6 . '<br>';



// str_replace(what searching for, what to change to, the string youre seaching) - replaces some of the string
    $text2 = 'Hello you';
    $output7 = str_replace('you', 'Everyone', $text2);
    echo $output7 . '<br>';



// is_string() - test to see if something is a string or not
    $val = 'Hello';
    $output8 = is_string($val);
// prints 1
    echo $output8 . '<br>';

    $values = [true, false, null, 'abc', 33, '33', 22.4, '', ' ', 0, '0'];
    
    foreach($values as $value){
        if(is_string($value)){
            echo "{$value} is a string" . "<br>";
        } else {
            echo "{$value} is not a string" . "<br>";
        }
    }



    $string = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint facere ab illo modi 
    itaque temporibus vitae doloremque omnis nesciunt fugit, commodi deserunt laboriosam velit 
    quibusdam aliquam sapiente tempore veniam reprehenderit!";
//  gzcompress() - compresses a string / gzuncompress - uncompresses a string
    $compressed = gzcompress($string);
    echo $compressed;
    echo '<br>';
    $original = gzuncompress($compressed);
    echo $original;



?>