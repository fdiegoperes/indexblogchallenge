<?php
/*****
 * Template Name: FDiegoPeres Contact Template
 */
 get_header();
 global $wpdb;
?>

<div class="container">
  <div class="form-group row">
    <form class="col-sm" method="post" id="contactForm">
      <p>
        <div class="col-md-12">
          <input class="form-control" type="text" name="userFirstName" id="userFirstName" placeholder="Name" value="<?php echo isset($_POST["userFirstName"]) ? $_POST["userFirstName"] : ''; ?>"> 
          <span class="error"> <?php echo $first_name_error; ?></span>
        </div>
      </p>
      <p>
        <div class="col-md-12">
          <input class="form-control" type="text" name="userLastName" id="userLastName" placeholder="Last Name" value="<?php echo isset($_POST["userLastName"]) ? $_POST["userLastName"] : ''; ?>"> 
          <span class="error"> <?php echo $last_name_error; ?></span>
        </div>
        
      </p>
      <p>
        <div class="col-md-12">
          <input class="form-control" ype="email" name="userEmail" id="userEmail" placeholder="Email Address" value="<?php echo isset($_POST["userEmail"]) ? $_POST["userEmail"] : ''; ?>"> 
          <span class="error"> <?php echo $email_error; ?></span>
        </div>
      </p>
      <p>
        <div class="col-md-12">
          <input class="form-control" type="tel" name="userPhoneNumber" id="userPhoneNumber" placeholder="Phone Number" value="<?php echo isset($_POST["userPhoneNumber"]) ? $_POST["userPhoneNumber"] : ''; ?>"> 
          <span class="error"> <?php echo $phone_error; ?></span>
        </div>
      </p>
      <p>
        <div class="col-md-12">
          <textarea class="form-control" type="text" name="userMessage" id="userMessage" placeholder="Message" value="<?php echo isset($_POST["userMessage"]) ? $_POST["userMessage"] : ''; ?>"> 
          </textarea>
          <span class="error"> <?php echo $message_error; ?></span>
        </div>
      </p>
      
      <input class="btn btn-primary" type="submit" value="Submit" name="btnSubmit">
    </form>

    <div class="col-sm">
      <div class="output">
        <p>

          <h3> <?php echo $user_message; ?></span> </h3>

        </p>
      </div>
    </div>
  </div>
</div>


<?php get_footer(); ?>