<?php
  // Fetching all the Navbar Data
  require('./includes/nav.inc.php');

  // Checking if the User is logged in already
  if(isset($_SESSION['USER_LOGGED_IN']) && $_SESSION['USER_LOGGED_IN'] == "YES") {
    
    // Redirected to home page
    redirect('./index.php');
  }

  // Whenever login button is pressed
  if(isset($_POST['login-submit'])) {

    // Fetching values via POST and passing them to user defined function 
    // to get rid of special characters used in SQL
    $loginEmail = get_safe_value($_POST['login-email']);
    $loginPassword = get_safe_value($_POST['login-password']);
    
    // Login Query to check if the email submitted is present or registered
    $loginQuery = " SELECT * FROM user 
                    WHERE user_email = '{$loginEmail}'";
    
    // Running the Login Query
    $result = mysqli_query($con, $loginQuery);
    
    // Returns the number of rows from the result retrieved.
    $rows = mysqli_num_rows($result);

    // If query has any result (records) => If any user with the email exists
    if($rows > 0) {

      // Fetching the data of particular record as an Associative Array
      while($data = mysqli_fetch_assoc($result)) {

        // Verifing whether the password matches the hash from DB
        $password_check = password_verify($loginPassword, $data['user_password']);
        
        // If password matches with the data from DB
        if($password_check) {

          // Setting user specific session variables
          $_SESSION['USER_NAME'] = $data['user_name'];
          $_SESSION['USER_LOGGED_IN'] = "YES";
          $_SESSION['USER_ID'] = $data['user_id'];
          $_SESSION['USER_EMAIL'] = $data['user_email'];

          // Unsetting all the author specific session variables
          unset($_SESSION['AUTHOR_NAME']);
          unset($_SESSION['AUTHOR_LOGGED_IN']);
          unset($_SESSION['AUTHOR_ID']);
          unset($_SESSION['AUTHOR_EMAIL']);

          // Redirected to home page
          redirect('./index.php');
        }

        // If the password fails to match
        else {

          // Redirected to login page along with a message
          alert("गलत पासवर्ड");
          redirect('./user-login.php');
        }
      }     
    }
    // If the email is not registered 
    else {

      // Redirected to signup page along with a message
      alert("यो इमेल दर्ता गरिएको छैन। कृपया दर्ता गर्नुहोस्");
      redirect('./user-login.php');
    }
  }

  // Whenever login button is pressed
  if(isset($_POST['signup-submit'])) {

    // Fetching values via POST and passing them to user defined 
    // function to get rid of special characters used in SQL
    $signupName = get_safe_value($_POST['signup-name']);
    $signupEmail = get_safe_value($_POST['signup-email']);
    $signupPassword = get_safe_value($_POST['signup-password']);

    // Creating new password hash using a strong one-way hashing algorithm => CRYPT_BLOWFISH algorithm
    $strg_pass = password_hash($signupPassword,PASSWORD_BCRYPT);
    
    // Check Query to check if the email submitted is present or registered already
    $check_sql = "SELECT user_email FROM user 
                  WHERE user_email = '{$signupEmail}'";
    
    // Running the Check Query
    $check_result = mysqli_query($con,$check_sql);
    
    // Returns the number of rows from the result retrieved.
    $check_row = mysqli_num_rows($check_result);
    
    // If query has any result (records) => If any user with the email exists
    if($check_row > 0) {

      // Redirecting to the login page along with a message
      alert("इमेल पहिल्यै अवस्थित छ");
      redirect('./user-login.php');
    }

    // If the query has no records => No user with the email exists (New User)
    else {

      // Signup Query to insert values into the DB
      $signupQuery = "INSERT INTO user 
                      (user_name, user_email, user_password) 
                      VALUES 
                      ('{$signupName}', '{$signupEmail}', '{$strg_pass}')";

      // Running the signup query
      $result = mysqli_query($con, $signupQuery);

      //If Query ran successfully
      if($result) {
        
        // Redirected to login page with a message
        alert("साइनअप सफल, कृपया लगइन गर्नुहोस्");
        redirect('./user-login.php');
      }
      
      // If the Query failed
      else {

        // Print the error
        echo "Error: ".mysqli_error($con);
      }
    }
  }
?>


<div class="container p-2">
  <!-- Container to store two form divs -->
  <div class="forms-container">
    <!-- Left div for login -->
    <div class="left">
      <div class="form-title">
        <h4>प्रयोगकर्ता लगइन</h4>
      </div>
      <div class="login-form-container">
        <!-- Form for Login -->
        <form method="POST" class="login-form" id="login-form">
          <div class="input-field">
            <input type="email" name="login-email" id="login-email" placeholder=" इमेल ठेगाना" autocomplete="off"
              required>
          </div>
          <div class="input-field">
            <input type="password" name="login-password" id="login-password" placeholder=" पासवर्ड" autocomplete="off"
              required>
          </div>
          <div class="input-field" style="margin-bottom: 20px;">
            <button type="submit"  name="login-submit">लगइन गर्नुहोस्</button>
          </div>

          <!-- horizontal line -->
          <div style="text-align: center; border-bottom: 1px solid #000; line-height: 0.1em; margin: 10px 0 5px;">
            <span style="background: #fff; padding: 0 10px;">वा</span>
          </div>

        </form>
        <div class="input-field">
            <a href="user-signup.php"><button style="cursor: pointer;">साइनअप गर्नुहोस्</button></a>
          </div>
      </div>
      <!-- Div to display the errors from the Login form -->
      <div class="form-errors">
        <p class="errors" id="login-errors"></p>
      </div>
    </div>
    

  </div>
</div>

<!-- Script for form Validation -->
<script src="./assets/js/form-validate.js"></script>

<?php

  // Fetching all the Footer Data
  require('./includes/footer.inc.php');
?>