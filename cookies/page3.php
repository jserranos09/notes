<?php
// how to store more than one piece of information
    $user = [
    'name' => 'Brad',
    'email' => 'test@test.com',
    'age' => '32'
    ];
// prepares the data to be stored
    $user = serialize($user);

    setcookie('user', $user, time() + (86400 +30));
// to to unserialize 
    $user = unserialize($_COOKIE['user']);
    echo $user['name'];
    echo '<br>';
    echo $user['email'];

?>