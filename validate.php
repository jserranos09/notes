<?php
// message variables
    $msg = '';
// going to change a succesful submission to green and a failed to red
    $msgClass = '';

// checks for a 'submit' (checks for the name='submit')
    if(filter_has_var(INPUT_POST, 'submit')){
// gets the form data after submitiing
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);  
        
// check required fields
// ! = not. checks if all these nre not true. !empty($email) = if email is not empty
        if(!empty($email) && !empty($name) && !empty($message)){
// passed
            echo 'Passed yo' . '<br>';
// checks email. if failed
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
// failed
                $msg = 'Please us a valid email';
// makes the message red
                $msgClass = 'alert-danger';
            } else {
// passed
                echo "Passed bro";
// who recieves the email
                $toEmail = 'superjr137@gmail.com';
// subject field
                $subject = 'Contact Request from ' . $name;
// body of email
                $body = '<h2>Contact Request</h2>
                    <h4>Name:</h4><p>' . $name . '</p>
                    <h4>Email:</h4><p>' . $email . '</p>
                    <h4>Message:</h4><p>' . $message . '</p>';
// content-type makes it an html and doesnt show the html tags
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";
// additonal headers 
                $headers .= "From: " . $name . "< " . $email . " >" . "\r\n";

                if(mail($toEmail, $subject, $body, $headers)){
// all works, email sent
                    $msg = 'Your email has been sent, thank ya buddy';
                    $msgClass = 'alert-success';
                } else {
// didnt work, failed
                    $msg = 'Email not sent! do better!';
                    $msgClass = 'alert-danger';
                }
            }
        } else {
// failed. if any are empty
            $msg = 'Please fill in ALL fields bro';
            $msgClass = 'alert-danger';
        } 
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">My website</a>
            </div>
        </div>
    </nav>
    <div class="container">
<!-- checks if there is a message. if message is not equal to empty -->
        <?php if($msg != ''): ?>
<!-- puts out the alert if not true -->
            <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
        <?php endif; ?>
<!-- $_SERVER uses super global variable -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>Name</label>
<!-- keeps the information in the text fields if a mistake is made. using shorthand code -->
                <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
            </div>
            <div class="form-check">
                <label>Message</label>                
                <textarea name="message" class="form-control" value=""><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
            </div>
            <Br>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>