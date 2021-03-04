<?php

/*
    FILTER_VALIDATE_BOOLEAN
    FILTER_VALIDATE_DOMAIN
    FILTER_VALIDATE_EMAIL
    FILTER_VALIDATE_INT
    FILTER_VALIDATE_URL
    FILTER_VALIDATE_IP

    FILTER_SANITIZE_EMAIL
    FILTER_SANITIZE_ENCODED
    FILTER_SANITIZE_NUMBER_INT
    FILTER_SANITIZE_SPECIAL_CHARS

*/


// checks for post/get 'data'
// if the method (in the form) is == to get, change to INPUT_GET (currently method="post")
    if(filter_has_var(INPUT_POST, 'data')){
        echo 'Data found' . '<br>';
    } else {
        echo 'No Data' .'<br>';
    }

// checks for data and if its en email address
// same as above, checks for data
    if(filter_has_var(INPUT_POST, 'data')){
        $email = $_POST['data'];

// removes illegal characters
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        echo $email . '<br>';

// checks input if its data and is an email
       if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo 'Email is valid' . '<br>';
        } else {
            echo 'Email is Not valid' . '<br>';
        }
    }
//----------------------------------------
    $var = '23';

    if(filter_var($var, FILTER_VALIDATE_INT)){
        echo "your number is $var" . '<br>';
    } else {
        echo 'Not a number' . '<br>';
    }
//-------------------------------------
    $number = '4524k5jbx98n34c89234c981z34cnxnqzx9834';
    var_dump(filter_var($number, FILTER_SANITIZE_NUMBER_INT));

    echo '<br>';

//------------------------------------
    $filters = [
        'data' => FILTER_VALIDATE_EMAIL,
        'data2' => [
            'filter' => FILTER_VALIDATE_INT,
            'options' => [
                'min_range' => 1,
                'max_range' => 100
            ]
        ]
    ];

// has to go through each step. If data isnt valid email and data 2 isnt a number between 1-100 then wont get through
    print_r(filter_input_array(INPUT_POST, $filters));

    echo '<br>';
//------------------------------------
    $arr = [
        'name' => 'juan serrano',
        'age' => '35',
        'email' => 'superjr137@gmail.com'
    ];

    $filters2 = [
        'name' => [
            'filter' => FILTER_CALLBACK,
// capitalizes first letters
            'options' => 'ucwords'  
        ],
        'age' => [
            'filter' => FILTER_VALIDATE_INT,
            'options' => [
                'min_range' => 1,
                'max_range' => 120
            ]
        ],
        'email' => FILTER_VALIDATE_EMAIL
    ];
// makes sure that the $arr info is validated. Wont save if isnt validated 
    print_r(filter_var_array($arr, $filters2));

    
?>

<!-- php_self dynamitcly shows the current page-->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
    <input type="text" name="data">
    <input type="text" name="data2">
    <button type="submit">Submit</button>
</form>

