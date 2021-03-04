<?php 
// must include this or wont work
    session_start();

    $_SESSION['name'] = 'John Doe';

// retrieves the sessions from page1 
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
?>
<html lang="en">
<head>
    <title>php sessions</title>
</head>
<body>
    <h5>Thank you <?php echo $name; ?>, You have subscribed with the email <?php echo $email; ?></h5>
    <a href="page3.php">Go to page 3</a>
</body>
</html>