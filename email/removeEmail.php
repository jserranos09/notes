<!-- doesnt work-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
</head>
<body>
    <img src="https://resources.oreilly.com/examples/9780596006303/raw/master/ch03/initial/makemeelvis/elvislogo.gif" alt="make me elvis">
    <h4>Enter an email address to remove it:</h4>
    <!-- self referencing so dont need html page-->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <?php
        $dbc = mysqli_connect("localhost", "juan", "juan", "aliendatabase")
            or die("Didn't work");
        
        if (isset($_POST['submit'])) {
            // foreach (array to use, where to store them) ex: foreach ($customers as customers)
            foreach ($_POST['todelete'] as $delete_id) {
                // each person selected is now put in delete_id
                $query = "DELETE FROM email_list WHERE id = $delete_id";
                mysqli_query($dbc,$query)
                    or die('Error querying database');
            }
            echo 'Customer(s) removed. <br />';
        }

        // getting data from a databse. selects all the colomuns from email_list
        $query = "SELECT * FROM email_list";
        // how php communicates with MYSQL server. mysqli_query(database_connection, query)
        $result = mysqli_query($dbc, $query);
        // mysqli_fetch_array: retirives a single row of data from the query result and stores it in the array. Each time it runs it gets info for the next row
        while ($row = mysqli_fetch_array($result)) {
            // puts a checkbox in front of a name and email to select to delete. $row[id]: where the primary key is used. todelete[]: puts checkbox values in this array,[] is needed to make it an array
            echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]" />';
            echo $row['first_name'];
            echo ' ' . $row['last_name'];
            echo ' ' . $row['email'];
            echo '<br />';
        }

        mysqli_close($dbc);
    ?>
        <!-- adds a remove button. can name this whaterver  -->
        <input type="submit" name="submit" value="Remove" />

    </form>
</body>
</html>

