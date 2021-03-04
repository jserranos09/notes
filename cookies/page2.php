<?php
// how to change/update cookie. time set for a day
    setcookie('username', 'Frank', time()+ (86400 * 30));

// how to unset/delete. set up time to something inthe past
//    setcookie('username', 'Frank', time() - 3600);

// check if there are any cookies
    if(count($_COOKIE) > 0){
        echo 'There are ' . count($_COOKIE) . ' cookies saved <br>';
    } else{
        echo 'There are no cookies';
    }
    
    if(isset($_COOKIE['username'])){
        echo 'User ' . $_COOKIE['username'] . ' is set <br>';
    } else {
        echo 'User is not set';
    }
?>