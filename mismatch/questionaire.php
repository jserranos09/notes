<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Questionnaire';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');
/* so i can see the page without being logged in.
  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
  }
*/
  // Show the navigation menu
  require_once('navmenu.php');

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // If this user has never answered the questionnaire, insert empty responses into the database
  $query = "SELECT * FROM mismatch_response WHERE user_id = '" . $_SESSION['user_id'] . "'";
  $data = mysqli_query($dbc, $query);
  //checks to see if the query returned 0 rows which means no data
  if (mysqli_num_rows($data) == 0) {
    // First grab the list of topic IDs from the topic table. 
    $query = "SELECT topic_id FROM mismatch_topic ORDER BY category_id, topic_id";
    $data = mysqli_query($dbc, $query);
    $topicIDs = array();
    while ($row = mysqli_fetch_array($data)) {
      array_push($topicIDs, $row['topic_id']);
    }

    // Insert empty response rows into the response table, one per topic
    foreach ($topicIDs as $topic_id) {
      // the response row is unanswered at this point. 
      $query = "INSERT INTO mismatch_response (user_id, topic_id) VALUES ('" . $_SESSION['user_id']. "', '$topic_id')";
      mysqli_query($dbc, $query);
    }
  }

  // If the questionnaire form has been submitted, write the form responses to the database
  if (isset($_POST['submit'])) {
    // Write the questionnaire response rows to the response table
    foreach ($_POST as $response_id => $response) {
      // all that changes when user submits the form id the response column of the response table
      $query = "UPDATE mismatch_response SET response = '$response' WHERE response_id = '$response_id'";
      mysqli_query($dbc, $query);
    }
    echo '<p>Your responses have been saved.</p>';
  }

  // Grab the response data from the database to generate the form. AS makes alias for a coloumn or table so mr=mismatch_response, etc.
  // joins different categories together from different tables. 
  $query = "SELECT mr.response_id, mr.topic_id, mr.response, mt.name AS topic_name, mc.name AS category_name " .
    //AS makes alias for a coloumn or table so mr=mismatch_response, etc.
    "FROM mismatch_response AS mr " .
    // grabs the topic table into the query
    "INNER JOIN mismatch_topic AS mt USING (topic_id) " .
    // grabs category table/name. Also can be written: ON (mismatch_topic.catergory_id = mismatch_category.category_id). below can be used if the matching columns have the same name. 
    "INNER JOIN mismatch_category AS mc USING (category_id) " .
    // WHERE isolates just one row (Sessions user id)
    "WHERE mr.user_id = '" . $_SESSION['user_id'] . "'";
  $data = mysqli_query($dbc, $query);
  $responses = array();
  while ($row = mysqli_fetch_array($data)) {
    // stores all the query results data in the $responses array
    array_push($responses, $row);
  }

  mysqli_close($dbc);

  // Generate the questionnaire form by looping through the response array / mismatch_response. Action references itself
  echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
  echo '<p>How do you feel about each topic?</p>'; 
  // grabs the category of the first response to get started before entering the loop
  $category = $responses[0]['category_name'];
  // each category is created as a fieldset to organize topics together 
  echo '<fieldset><legend>' . $responses[0]['category_name'] . '</legend>';
  // loops through mismatch_response array 
  foreach ($responses as $response) {
    // Only start a new fieldset if the category has changed
    if ($category != $response['category_name']) {
      $category = $response['category_name'];
      echo '</fieldset><fieldset><legend>' . $response['category_name'] . '</legend>';
    }

    // Display the topic form field. uses ternary operator for easy if-else statements: expressions ? (if true)statement1 : (if false)statement2. 
    // this ternary changes the style of the label for unanswered topics. Each topic is created as a label followed by the 'Love', 'Hate' radio buttons 
    echo '<label ' . ($response['response'] == NULL ? 'class="error"' : '') . ' for="' . $response['response_id'] . '">' . $response['topic_name'] . ':</label>';
    // generates the love button. checked attribute controls the selection of the buttons. response_id uniquely makes the html form fields ans associates each field with a database row
    echo '<input type="radio" id="' . $response['response_id'] . '" name="' . $response['response_id'] . '" value="1" ' . ($response['response'] == 1 ? 'checked="checked"' : '') . ' />Love ';
    // generates the hate button. form fiels are tied to ther database rows by setting the "name" of each field to the primary key of the database (the number the questions is tied to)
    echo '<input type="radio" id="' . $response['response_id'] . '" name="' . $response['response_id'] . '" value="2" ' . ($response['response'] == 2 ? 'checked="checked"' : '') . ' />Hate<br />';
  }
  echo '</fieldset>';
  echo '<input type="submit" value="Save Questionnaire" name="submit" />';
  echo '</form>';

  // Insert the page footer
  require_once('footer.php');
?>