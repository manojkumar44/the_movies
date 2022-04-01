
<?php # Pagination Script for Movies

include "includes/header.html";
require_once "../movies_mysqli_connect.php";

// Set the number of records to display per page
$results_per_page = 5;

// Check if the number of required pages has been already determined
if (isset($_GET["p"]) && is_numeric($_GET["p"])) {
    $pages = $_GET["p"];
} else {  // If the number of required pages has not already been determined then
    //  count the number of records in the database:
    $q = "SELECT COUNT(movie_id) FROM movies";
    $r = @mysqli_query($dbc, $q);
    $row = @mysqli_fetch_array($r, MYSQLI_NUM);
    $records = $row[0];

    // Mathematically calcualte how many pages are required:
    // If the number of records in our table is greater than the maximum number of
    // records to display per page,  we will need more pages.
    if ($records > $results_per_page) {
        $pages = ceil($records / $results_per_page); //  get the highest integer from this calculation
    } else {  // If the number of records is less than $display then
        $pages = 1; // we only need one page (no pagination required)
    }
} // End of if( isset($_GET['p']) ) IF

// Determine where in the database to start counting results...
if (isset($_GET["s"]) && is_numeric($_GET["s"])) {
    $start = $_GET["s"];
} else {
    $start = 0;
} // End of if (isset($_GET['s']) IF

// Write the select query with the LIMIT clause
$q = "SELECT movie_id, movie_title, movie_cover_img, year_released FROM movies
    ORDER BY movie_title ASC LIMIT $start, $results_per_page";

$r = @mysqli_query($dbc, $q);
if ($r) {
  $num = mysqli_num_rows($r);
    if ($num > 0) {
        echo '<div class="tbl">
                <div class="tbl_row" id="tbl_headings_row">
                  <div class="tbl_cell" id="tbl_heading_id">Movie ID</div>
                  <div class="tbl_cell" id="tbl_heading_title">Movie Title</div>
                  <div class="tbl_cell" id="tbl_heading_img">Movie Poster</div>
                  <div class="tbl_cell" id="tbl_heading_year">Year Released</div>
                </div>';

        // Fetch and print all the records:
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            echo '<div class="tbl_row"><div class="tbl_cell">' . $row["movie_id"] . '</div>
                  <div class="tbl_cell">' . $row["movie_title"] . '</div>
                  <div class="tbl_cell"><img class="img_responsive mov_img" src="assets/img/' . $row["movie_cover_img"] . '"/></div>

                  <div class="tbl_cell">' . $row["year_released"] . '</div>
                  </div>';
        }       // End of while loop

        // Close the table
        echo "</div>";

        // Free up the resources
        mysqli_free_result($r);

        // Close the database connection
        mysqli_close($dbc);
    } else {
        echo '<p class="error"> No movies found in database</p>';
    } // End of if ($num > 0) IF
} else {
    echo '<p class="error">Sorry but we were unable to retrieve movies from the database. Please try again later.</p>';
    // Debugging message
    echo "<p>" . mysqli_error($dbc) . "<br /><br />Query: " . $q . "</p>";
} // End of if($r) IF

// Begin a section for displaying links to other pages if necessary
// If the total no. of pages is greater than 1
if ($pages > 1) {
    echo '<br /><div class="pagination_block">';

    // Determine the current page
	   $current_page = ($start / $results_per_page) + 1;
     $first_page = 1;

    if($current_page != $first_page)	{ // If the current page is NOT the first page
      // Show a 'Previous' link
      echo	'<a href="view_movies.php?s=' . ($start - $results_per_page) . '&p=' . $pages . '">Previous</a>';
    }
    // Make the numbered pagination links
    for ($i = 1; $i <= $pages; $i++) {
        if ($i != $current_page) {
            echo '<a href="view_movies.php?s=' .
                $results_per_page * ($i - 1) .
                "&p=" .
                $pages .
                '">' .
                $i .
                "</a> ";
        } else {
            echo '<a class="active" href="#">' . $i . '</a>';
        }
    } // End of for loop

    //  If the current page is NOT the last page, show a 'Next' link
    if ($current_page != $pages) {
        echo '<a href="view_movies.php?s=' .
            ($start + $results_per_page) .
            "&p=" .
            $pages .
            '">Next</a> ';
    }
    echo "</div>";
} // End of links section.
include "includes/footer.html";

?>
