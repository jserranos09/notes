<?php
// must include to work
    session_start();
// if $_SESSION is set (present), then $_SESSION['name'] is set as $name. if not, Guest
    $name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest';
    $name = isset($_SESSION['email']) ? $_SESSION['email'] : 'not subscribed';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php sessions</title>
</head>
<body>
    <h1>Hello <?php echo $name; ?></h1>
</body>
</html>