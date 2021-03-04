<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
</head>
<body>
    <?php
        include ("connectvars.php");

        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die("Didn't work");
        
        $first_name = $_POST['firstname'];
        $last_name = $_POST['lastname'];
        $email = $_POST['email'];

        
        $query = "INSERT INTO aliens_abduction (first_name, last_name, email) " . 
        "VALUES ('$first_name', '$last_name', '$email')";

        mysql_query($dbc, $query) 
            or die("This didn't work either");

        echo 'Added!';

        mysqli_close($dbc);

    ?>
</body>
</html>

