<!-- doesnt work -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
</head>
<body style="margin-left:10;">
    <img src="https://resources.oreilly.com/examples/9780596006303/raw/master/ch03/initial/makemeelvis/elvislogo.gif" alt="make me elvis">
    <?php
        // checks to see if the submit button has been submited to only output the error message after not all the time.
        if (isset($_POST['submit'])) {
            $from = 'Superjr137@gmail.com';
            $subject = $_POST['subject'];
            $text = $_POST['elvismail'];
            // a "flag". checks if we need to show the form again to input data. false means we dont show the form
            $output_form = false;

            //  checks both fields to see if either is empty
            if (empty($subject) && (empty($text))) {
                echo "<br /> Hey man, dont forget to fill in the fields" ;
                // output = true means the form will show again
                $output_form = true;
            }
            // checks is subject is empty
            if (empty($subject) && (!empty($text))) {
                echo "<br /> The subject is empty man. <br />";
                $output_form = true;
            }
            // checks if text is empty
            if (!empty($subject) && (empty($text))) {
                    echo "<br /> There's no body in the text bro <br />";
                    $output_form = true;
            }
            // both are not empty 
            if (!empty($subject) && (!empty($text))) {
                // connecting to a database        
                $dbc = mysqli_connect("localhost", "root", "1miguek1", "aliendatabase")
                    or die("Didn't work bro");

                // getting data from a databse. selects all the colomuns from email_list
                $query = "SELECT * FROM email_list";
                // how php communicates with MYSQL server. mysqli_query(database_connection, query)
                $result = mysqli_query($dbc, $query)
                    or die("Didn't work bra");
                // mysqli_fetch_array: retirives a single row of data from the query result and stores it in the array. Each time it runs it gets info for the next row
                while($row = mysqli_fetch_array($result)) {
                    // gets the info from database
                    $first_name = $row['first_name'];
                    $last = $row['last_name'];

                    $msg = "Dear $first_name $last_name, \n $text ";

                    $to = $row['email'];
                    // mail(where to send , the subject, message, where sent from) Sends this email to eahc person on email_lisy
                    mail($to, $subject , $msg, 'From ' . $from);

                    echo 'Email sent to: ' .  $to . '<br />';
                }

                mysqli_close($dbc);
            }

        } 
        else {
            // sets the output form to true if there are any mistakes to the form whichs dispalys an error messages.
            $output_form = true;
        }
        // if output_form is ever needed/called
        if ($output_form) {
    // gets out of php and runes the html form
    ?>
        <h3>Write and send email to mailing list</h3>
        <!-- super global php self stores the name of the current script (seneemail.php) so it can call itself when sent. Doesnt reply on the name of the script.-->
        <form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = 'post'>
          <label for="subject">Subject of email:</label> <br />
            <!-- The value echos itself after its submitted-->
          <input type="text" id="subject" name="subject" size="60" value="<?php echo $subject; ?>"/><br />
          <label for="elvismail">Body of email:</label> <br />
            <!-- The value echos itself after its submitted-->
          <textarea id="elvismail" name="elvismail" rows="8" cols="60"><?php echo $text; ?></textarea><br />
          <input type="submit" value="submit" name="submit" />
        </form>
    <?php
        // closes the output if statement
        }
    ?>
</body>
</html>

    