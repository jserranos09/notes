<?php 
// to catch the submission info from this page. uses the name=submit
    if(isset($_POST['submit'])){
// puts the username into a varriable 
        $username = htmlentities($_POST['username']);
//set cookie (name of cookie, value, expiration). this sets the time for 1 hour
        setcookie('username', $username, time()+3600);
// redirects to another page
        header('location: page2.php');
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP cookies</title>
</head>
<body>
<!-- the action makes it be submitted to this file (self) -->
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="username" placeholder="Enter username">
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>