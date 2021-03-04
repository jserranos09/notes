<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitar Wars - Add Your High Score</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <h2>Guitar Wars - Add Your High Score</h2>

<?php
    //  database connection contants
    require_once('appvars.php');
    require_once('connectvars.php');

    if (isset($_POST['submit'])) {
        // grabs the score data from the POST. trim cleans the input so no tricks can be made (for security purposes)
        $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
        // mysqli_real_escape_string is used to no special charaters are used (for security purposes). must connect to the database
        $score = mysqli_real_escape_string($dbc, trim($_POST['score']));
        // superglobal $_FILES is where PHP stores info about uploaded files (like POST)
        $screenshot = mysqli_real_escape_string($dbc, trim($_FILES['screenshot']['name']));
        $screenshot_type = $_FILES['screenshot']['type'];
        $screenshot_size = $_FILES['screenshot']['size'];

        $user_pass_phrase = SHA($_POST['verify']);
        if ($_SESSION['pass_phrase'] == $user_pass_phrase) {
            // checks if they are not empty or score is a number
            if (!empty($name) && is_numeric($score) && !empty($screenshot)) {
                if ((($screenshot_type == 'image/gif') || ($screenshot_type == 'image/jpeg') || ($screenshot_type == 'image/pjeg') || ($screenshot_type == 'image/png')) && ($screenshot_size > 0) && ($screenshot_size <= GW_MAXFILESIZE)) {
                    // checks the $_FILES superglobal to see if there are any errors 
                    if ($_FILES['screenshot']['error'] == 0) {
                        // moves the file to the target folder. (GW=guitar wars) GW_UPLOADPATH= images/. holds the path to our images. 
                        $target = GW_UPLOADPATH . $screenshot;
                        // gets the source location of a file (screenshot) and sends it to another location ($target)
                        if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {
                            // connects to the database
                            $dbc = mysqli_connect('localhost', 'juan', 'juan', 'juan')
                                or die("Didn't work");
                            // writes data into the database. NOW()= inserts the current date/time. id column gets auto set so the "0" gets ignored 
                            // VALUES (id, date, name, score, screenshot)
                            $query = "INSERT INTO aliens_abduction VALUES (0, NOW(), '$name', '$score', '$screenshot')";
                            mysqli_query($dbc, $query);
                            // confirms success with the user
                            echo '<p>Thanks for adding your new high score!</p>';
                            echo '<p><strong>Name:</strong> ' . $name . '<br />';
                            echo '<strong>Score:</strong> ' . $score . '<br />';
                            echo '<img src="' . GW_UPLOADPATH . $screenshot . '" alt="Score Image" /></p>';
                            // &lt= arrow pointing left
                            echo '<p><a href="index.php">&lt;&lt; Back to high scores</a></p>';
                            // Clear the score data to clear the form
                            $name = "";
                            $score = "";
                            $screenshot = "";

                            mysqli_close($dbc);
                        } else {
                            // displays an discriptive error if the code is wrong, telling the user why its wrong
                            echo '<p class="error"> Error with file move.</p>';
                        }
                    }    
                } else {
                    echo '<p class="error">The screen shot must be a GIF, JPEG or PNG file no greater than ' . (GW_MAXFILESIZE / 1024) . ' KB in size.</p>';
                }
                    // unlink()= deltes a file from the web server.  the @ hides the error that may show
                    @unlink($_FILES['screenshot']['tmp_name']);
            } else {
                echo '<p class="error">Please enter all of the information to add your high score</p>';
            }
        } else {
          echo '<p class="error">Please enter the verification pass-phrase exactly as shown.</p>';
        }
    }
?>  
    <!-- adds a line across the screen``````-->
    <hr />
    <!-- this enctype tells for to use special type of encoding required for file uploading. affects how the POST data is bundled and sent-->
    <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <!-- makes max fild size 32,768 bytes (32 kb)-->
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo GW_MAXFILESIZE; ?>" ?>
        <label for="name">Name:</label>
        <!-- keeps the words in the field so they dont have to reputting the info in-->
        <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" />
        <br /> 
        <label for="score">Score:</label>
        <input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>" />
        <br />
        <label for="screenshot">Screen shot:</label>
        <input type="file" id="screenshot" name="screenshot" />
        <label for="verify">Verification:</label>
        <input type="text" id="verify" name="verify" value="Enter the pass-phrase." /> <img src="/notes/phpbook/guitarwars/captcha.php" alt="Verification pass-phrase" />
        <hr />
        <input type="submit" value="Add" name="submit" />  
    </form>
</body>
</html>



