<?phP

// if statement checks to see if 'name' exist
// Prints whatever name is submited in form 
    if(isset($_GET['name'])){
        print_r($_GET);
        $name = htmlentities($_GET['name']);
        echo $name;
        echo $email;
    }
/*
// used for protection/safety
        $name = htmlentities($_GET['name']);
        echo $name;
    }
// must change the method to 'POST'. a more secure way to send data
    if(isset($_POST['name'])){
        print_r($_POST);
        $name = htmlentities($_GET['name']);
        echo $name;
    }
// not used as much
    if(isset($_REQUEST['name'])){
        print_r($_REQUEST);
        $name = htmlentities($_REQUEST['name']);
        echo $name;
    }
*/
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>my website</title>
</head>
<body>
<!-- action is the page we will be submittinbg to -->
    <form method="GET" action="test.php">
        <div>
            <label>Name</label><br>
<!-- name attribute links to server to get data submited -->
            <input type="text" name="name">
        </div>
        <div>
            <label>Email</label><br>
            <input type="text" name="email">
        </div>
        <input type="submit" value="Submit">
    </form>
    <ul>
        <li>
            <a href="test.php?name=brad">Brad</a>
            <a href="test.php?name=Steve">Steve</a>
        </li>
    </ul>
    <h1><?php echo "{$name}'s Profile"; ?></h1>
</body>
</html>