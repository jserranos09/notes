<?php
  require_once('authorize.php');
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Guitar Wars - Remove a High Score</h2>
    <p>Below is a list of all Guitar Wars high scores. Use this page to remove scores as needed</p>
    <hr />
<?php
//  database connection contant from appvars and connectvars
    require_once('appvars.php');
    require_once('connectvars.php');

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die("Didn't work");

    $query = "SELECT * FROM aliens_abduction ORDER BY score DESC, date ASC";
    $data =  mysqli_query($dbc, $query);

// loop through the array of score data, formating it as html
    echo '<table>';
    echo '<tr><th>Name</th><th>Date</th><th>Score</th><th>Action</th></tr>';

    while ($row = mysqli_fetch_array($data)) {
// displays the socre data
        echo '<tr class="scorerow"><td><strong>' . $row['name'] . '</strong></td>';
        echo '<td>' . $row['date'] . '</td>';
        echo '<td>' . $row['score'] . '</td>';
// generates an html link to removescore.php. passes data to the script as a GET request
        echo '<td><a href="removescore.php?id=' . $row['id'] . '&amp;date=' . $row['date'] . '&amp;name=' . $row['name'] . '&amp;score=' . $row['score'] .
        '&amp;screenshot=' . $row['screenshot'] . '">Remove</a>';
        if ($row['approved'] == '0') {
// approve link ties the admin page to the approve page. generates the aprrove link which passes all the info through it.
            echo ' / <a href="approvescore.php?id=' . $row['id'] . '&amp;date=' . $row['date'] .
              '&amp;name=' . $row['name'] . '&amp;score=' . $row['score'] . '&amp;screenshot=' . $row['screenshot'] . '">Approve</a>';
          }
          echo '</td></tr>';
    }
    echo '</table>';
    
    mysqli_close($dbc)
?>
</body>
</html>
