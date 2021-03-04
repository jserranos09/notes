<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Risky Jobs - Search</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <img src="photos/riskyjobs_title.gif" alt="Risky Jobs" />
  <img src="photos/riskyjobs_fireman.jpg" alt="Risky Jobs" style="float:right" />
  <h3>Risky Jobs - Search Results</h3>

<?php
  // This function builds a search query from the search keywords that are entered by the user. Also uses $sort 
  function build_query($user_search, $sort) {
    $search_query = "SELECT * FROM riskyjobs";

    // str_replace= replaces commas with a space so our search doesnt include commas
    $clean_search = str_replace(',', ' ', $user_search);
    // explode function breaks a string into an array of substrings (so the words we search dont have to be exact)
    // explode requires 2 parameters 'delimter'= what seperates the substring (which is a space) and 'where'=what we want exploded ($clean_search)
    $search_words = explode(' ', $clean_search);
    // makes an array of the search words we want after the user submits them
    $final_search_words = array();
    if (count($search_words) > 0) {
      // loop throguh each element of the $search_words array. if the element is not empty (isnt just a space), put it in the array named $final_search_words
      foreach ($search_words as $word) {
        if (!empty($word)) {
          $final_search_words[] = $word;
        }
      }
    }

    // Generate a WHERE clause using all of the search keywords
    $where_list = array();
    // uses the $final_search_words array that contains no empty elements
    if (count($final_search_words) > 0) {
      foreach($final_search_words as $word) {
        // % means any characters before and after. LIKE  looks for matches that aren't exactly the same as what is searched. case-sensative
        $where_list[] = "description LIKE '%$word%'";
      }
    }
    // implode is the opposite of explode. takes an array of strings and builds a single string.
    // explode requires 2 parameters, a delimter (' OR ')= this is between each string when they are together and 'where'=what we want exploded ($where_list)
    $where_clause = implode(' OR ', $where_list);

    // Add the keyword WHERE clause to the search query
    if (!empty($where_clause)) {
      $search_query .= " WHERE $where_clause";
    }

    // switch contains a series of CASE labels that execute different code blocks depending on the value of a variable. 
    switch ($sort) {
    // Ascending by job title. This only exectues if $sort is equal to 1. 
    case 1:
      $search_query .= " ORDER BY title";
      break;
    // Descending by job title
    case 2:
      // DESC sorts in a desending order
      $search_query .= " ORDER BY title DESC";
      break;
    // Ascending by state
    case 3:
      $search_query .= " ORDER BY state";
      break;
    // Descending by state
    case 4:
      $search_query .= " ORDER BY state DESC";
      break;
    // Ascending by date posted (oldest first)
    case 5:
      $search_query .= " ORDER BY date_posted";
      break;
    // Descending by date posted (newest first)
    case 6:
      $search_query .= " ORDER BY date_posted DESC";
      break;
    // $sort will be empty so results wont sort
    default:
      // No sort setting provided, so don't sort the query
    }
    // returns the query so the code that calls the function can use it.
    return $search_query;
  }

  // This function builds hyperlinks for the search result headings the sort the results
  function generate_sort_links($user_search, $sort) {
    $sort_links = '';

    switch ($sort) {
    case 1:
      //<td> makes the result generation as part of an HTML table. $_SERVER['PHP_SELF'] makes it reload the page when a user clicks on the title (self referencing)
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=2">Job Title</a></td><td>Description</td>';
      // build_query function needs the users keywords to display result, $user_search passes it in the url
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">State</a></td>';
      // sort=5 is the case 5 code above for Date. 
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=5">Date Posted</a></td>';
      break;
    case 3:
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=1">Job Title</a></td><td>Description</td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=4">State</a></td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">Date Posted</a></td>';
      break;
    case 5:
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=1">Job Title</a></td><td>Description</td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">State</a></td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=6">Date Posted</a></td>';
      break;
    default:
      // this is the default if the user doesnt click on anything.
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=1">Job Title</a></td><td>Description</td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">State</a></td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=5">Date Posted</a></td>';
    }

    return $sort_links;
  }

  // This function builds navigational page links based on the current page and the number of pages
  function generate_page_links($user_search, $sort, $cur_page, $num_pages) {
    $page_links = '';

    // If this page is not the first page, generate the "previous" link
    if ($cur_page > 1) {
      $page_links .= '<a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . ($cur_page - 1) . '"><-</a> ';
    }
    else {
      $page_links .= '<- ';
    }

    // Loop through the pages generating the page number links
    for ($i = 1; $i <= $num_pages; $i++) {
      // $i = the link to a specific page is the page number 
      if ($cur_page == $i) {
        $page_links .= ' ' . $i;
      }
      else {
        $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . $i . '"> ' . $i . '</a>';
      }
    }

    // If this page is not the last page, generate the "next" link
    if ($cur_page < $num_pages) {
      $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . ($cur_page + 1) . '">-></a>';
    }
    else {
      // the next page link shows up as an arrow
      $page_links .= ' ->';
    }

    return $page_links;
  }

  // Grab the sort setting and search keywords from the URL using GET
  $sort = $_GET['sort'];
  // grabs the search string the user entered into the form
  $user_search = $_GET['usersearch'];

  // gets the current page from the script URL VIA $_GET. if no current page is passed through the URL, set $cur_page to the first page (1)
  $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $results_per_page = 5;  // number of results per page
  // dont understand this. controls where each oage begins in terms of results, providing the first argument to the LIMIT clause.
  $skip = (($cur_page - 1) * $results_per_page);

  // Start generating the table of results
  echo '<table border="0" cellpadding="2">';

  // Generate the search result headings
  echo '<tr class="heading">';
  // calls generate_sort_links function to create the links for the result headings then echo them
  echo generate_sort_links($user_search, $sort);
  echo '</tr>';

  // Connect to the database
  require_once('connectvars.php');
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Query to get the total results with no LIMIT 
  $query = build_query($user_search, $sort);
  $result = mysqli_query($dbc, $query);
  // Run the query the retrieves all the rows with no LIMIT. counts the results and store in $total. the total number of results. 
  $total = mysqli_num_rows($result);
  // compute the number of pages using $total divided by $results_per_page. ceil rounds the number to the nearest interger. 
  $num_pages = ceil($total / $results_per_page);

  // LIMIT shows only a number of results per page. $results_per_page is = 5. 
  // $query is the = to the build_query function whichs gets the results and sort from the user.
  $query =  $query . " LIMIT $skip, $results_per_page";
  // this querys the result but with a LIMIT
  $result = mysqli_query($dbc, $query);
  while ($row = mysqli_fetch_array($result)) {
    echo '<tr class="results">';
    echo '<td valign="top" width="20%">' . $row['title'] . '</td>';
    echo '<td valign="top" width="50%">' . $row['description'] . '</td>';
    echo '<td valign="top" width="10%">' . $row['state'] . '</td>';
    // substr only shows part of the data. (original string, where to start the string, length). will only show the date and not the time
    echo '<td valign="top" width="20%">' . substr($row['date_posted'], 0, 10) . '</td>';
    echo '</tr>';
  } 
  echo '</table>';

  // Generate navigational page links if we have more than one page
  if ($num_pages > 1) {
    // $user_search = shows the the user is actually searching for
    // $sort = maintains the order of jobs
    // $cur_page =  page navigation depends on the current page
    // $num_pages = how many pages there are
    echo generate_page_links($user_search, $sort, $cur_page, $num_pages);
  }

  mysqli_close($dbc);
?>

</body>
</html>