<?php 
// sessions are saved on the server (cookies on the computer/browsers). should use sessions

// to catch the submission info from this page. uses the name=submit
    if(isset($_POST['submit'])){
// starts a session to be used in another page. must include on all pages
        session_start();
// taking the post values and putting into session variables
        $_SESSION['name'] = htmlentities($_POST['name']);
        $_SESSION['email'] = htmlentities($_POST['email']);

// redirects to a new page
        header('location: page2.php');
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Sessions</title>
</head>
<body>
<!-- action makes it be submitted to this file (self) -->
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="name" placeholder="Enter Name yo">
        <br>
        <input type="text" name="email" placeholder="Enter Email yo">
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>