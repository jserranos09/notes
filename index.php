<?php
// works with the file system and file paths

// variable that directs to a file
    $path = '/dir0/dir1/myfile.php';
    $file = 'file1.txt';

// returns the file name (myfile.php)
    echo basename($path);
    echo '<br>';

// returns filename without ext
    echo basename($path, '.php');
    echo '<br>';

// returns the directory name from path
    echo dirname($path);
    echo '<br>';
    
// checks if a file exsist. returns '1' if true
    echo file_exists($file);
    echo '<br>';

// gets the absolute path
    echo realpath($file);
    echo '<br>';

// checks if a file is writeable. returns 1 if true
    echo is_writable($file);
    echo '<br>';

// gets the file size. returns '6' because its 6 bites 
    echo filesize($file);
    echo '<br>';

// creates a directory       will delete a directory (if empty)
//    mkdir('testing');      rmdir('testing);

// rename a file (what file, what to change to)
//    rename('file1.txt', 'myfile.txt');

// open a file for reading. prints whats in the file (wassup)
    $handle = fopen($file, 'r');
    $data = fread($handle, filesize($file));
    echo $data;
?>