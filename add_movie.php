<?php # Add Movie Script

    $page_title = "Add Movie";
    include "includes/header.html";

    // The first conditional below will check for how the script is being requested.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // The errors variable will be used to store every error message (one for
      // each form input properly filled out)

      require_once "../movies_mysqli_connect.php"; // connect to the db.

      $errors = array();

      // Check for a movie title
      if (empty($_POST['movie_title'])) {
        $errors[] = "You did not enter a movie title.";
      } else {
        $mov_title = mysqli_real_escape_string($dbc, trim($_POST['movie_title']));
      }



      // Check for a movie cover image
      if (!isset($_FILES['movie_image'])) {
        $errors[] = "Your did not add a movie image.";
      } else {
        // Define an array that hold sthe permitted file types for upload
        $valid_img_file_types = array('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/png', 'image/x-png');

        // If our file type qualifies as one of the permitted file types:
        if (in_array($_FILES['movie_image']['type'], $valid_img_file_types)) {
          // Declare two variables, one to house the actual image and its name and one to house
          // the the temporary storage location where we will need to move the image from
          $post_mov_image = $_FILES['movie_image']['name'];
          $post_mov_image_temp = $_FILES['movie_image']['tmp_name'];

          // And lets begin moving the image across to destination folder from the temp folder
          if (move_uploaded_file($post_mov_image_temp, "assets/img/$post_mov_image")) {
            echo "<h6>File Upload Successful!</h6>";
          } else {  // Something went wrong, report back to user
            echo "<h6>There was a problem uploading the image. Please check your php.ini settings and try again.</h6>";
          }
        } else {  // Invalid file type - report back to user
          echo "<h6>Invalid File Type. Please go back and try again.</h6>";
        } // End of if (in_array($_FILES)) IF
      } // End of if (empty($_FILES['movie_image'])) IF

      // If there was an error when attempting file upload, what was it ? Lets find out..
      if ($_FILES['movie_image']['error'] > 0) {
        echo "<h6>Your file could not be uploaded onto our server because: ";

        // Output the appropriate message corresponding to the error code
        switch ($_FILES['movie_image']['error']) {
          case 1:
          echo 'The file exceeded the upload_max_filesize setting in the php.ini file';
          break;

          case 2:
          echo 'The file exceeded the MAX_FILE_SIZE setting in the html form';
          break;

          case 3:
          echo 'The upload was interrupted and/or unable to fully complete';
          break;

          case 4:
          echo 'No file was uploaded onto the server';
          break;

          case 6:
          echo 'Unable to detect and locate a temporary folder for uploads.';
          break;

          case 7:
          echo 'Unable to write to the disk.';
          break;

          case 8:
          echo 'The file upload was stopped.';
          break;

          default:
          echo 'A system error occurred';
          break;
        } // End of switch statement
        echo '</h6>';
        echo "<br/>";
      } // End of if ($_FILES['post_image']['error'] > 0) IF

      // If the file still in the temporary folder ? If so lets delete it
      if (file_exists ($_FILES['movie_image']['tmp_name']) && is_file($_FILES['movie_image']['tmp_name']) ) {
        unlink ($_FILES['movie_image']['tmp_name']);
      }


      // Check if year of release was entered
      if (empty($_POST['movie_year_released'])) {
          $errors[] = "You did not enter the movie's year of release";
        } else {
          $mov_year = mysqli_real_escape_string($dbc, trim($_POST['movie_year_released']));
      }



      if (empty($errors)) { // If everything is OK


        // Make the query:
        $q = "INSERT INTO movies (movie_title, movie_cover_img, year_released) VALUES ('$mov_title', '$post_mov_image', '$mov_year')";

        // Add the user to the database (execute the above query)
        $r = @mysqli_query($dbc, $q);

        // If the query ran OK
        if ($r) {

          // Print a message
          echo "<h1>Thank You!</h1><p>New Movie added to the Database!</p><p><br /><p>";
          header("Refresh: 3"); // here 3 is in seconds

        } else {  // If the query did NOT run ok..
            // Public message
           echo '<h1>System Error</h1><p class="error">The movie could not be added to the database due to a system error. We apologise for any inconvenience.</p>';

           // Debugging message:
           echo '<p>' . mysqli_connect_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
        } // End of if ($r) IF

        mysqli_close($dbc); // Close the database connection.

        // Include the footer and qui the script:
        include('includes/footer.html');
        exit();

      } else {  // Report the errors

          echo '<h1>Error!</h1><p class="error">The following error(s) occurred:<br />';
          foreach($errors as $msg) { // Print each error
            echo " - $msg<br /><br />";
          }

      echo '</p><p>Please try again.</p><p><br /></p>';

    } // End of if (empty($errors)) IF.

    mysqli_close($dbc); // close the database connection

  } //  End of the main Submit conditional.
 ?>
 <h1>Add New Movie</h1>
 <form action="add_movie.php" method="post" enctype="multipart/form-data">
   <div class="form_container">
     <p>Please fill out the movie details below</p>
     <label for="add_movie_title"><b>Movie Title:</b></label>
       <input type="text" name="movie_title" id="add_movie_title" size="15" maxlength="100" value="<?php
       if (isset($_POST['movie_title'])) echo $_POST['movie_title']; ?>" />

      <label for="add_movie_img"><b>Movie Image:</b></label>
        <input type="file" name="movie_image" id="add_movie_img">

      <!-- <label for="add_movie_rating"><b>Movie Rating:</b></label>
        <input type="number" name="movie_rating" id="add_movie_rating" min="1" max="10">-->

      <label for="add_year_released"><b>Year Released:</b></label>
      <?php $current_year = date("Y"); ?>
        <input type="number" name="movie_year_released" min="1900" max="2099" step="1">


      <p><input type="submit" name="submit" id="sbmt_btn" class="submit_button" value="Add Movie" /></p>
 </div>
 </form>
 <?php include ("includes/footer.html"); ?>
