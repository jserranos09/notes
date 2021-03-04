<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitar Wars - High Score</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <h2>Guitar Wars - High Scores</h2>
    <p>Welcome Gurtar Warrior! Do you have what it takes to crack the high school list? If, so, just <a href="addscore.php">Add your own score</a></p>
    <hr />

<?php 
//  database connection contants
  require_once('appvars.php');
  require_once('connectvars.php');

// connecting to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
    or die("Didn't work");

// get the score data from database
  $query = "SELECT * FROM aliens_abduction WHERE approved = 1 ORDER BY score DESC, date ASC";
  $data = mysqli_query($dbc, $query);

// loops through the array od score data and makes an html page
  echo '<table>';
// the variable that counts throguh the high scores
  $i = 0;
  while ($row = mysqli_fetch_array($data)) {
// if $i equals 0, we know its the first (top) score
    if ($i == 0) {
// topscorehaeder style class stored in style.cc
      echo '<tr><td colspan="2" class="topscoreheader">Top Score: ' . $row['score'] . '</td></tr>';
    }
// displays the score data
    echo '<tr><td class="scoreinfo">';
    echo '<span class="score">' . $row['score'] . '</span><br />';
    echo '<strong>Name:</strong> ' . $row['name'] . '<br />';
    echo '<strong>Date:</strong> ' . $row['date'] . '</td>';
// is_file:checks to see if an img exist.  filesize: makes sure img file size is > 0 (makes sure it isnt an emapty file)
    if (is_file(GW_UPLOADPATH . $row['screenshot']) && filesize(GW_UPLOADPATH . $row['screenshot']) > 0) {
      echo '<td><img src="' . GW_UPLOADPATH . $row['screenshot'] . '" alt="Score image"/></td></tr>';
    } else {
        echo '<td><img src="' . GW_UPLOADPATH . 'unverified.gif' . '" alt="Unverified score" /></td></tr>';
    }   
// adds 1 each time its used
    $i++;
  }   
  echo '</table>';

  mysqli_close($dbc);
?>
</body>
</html>

