<?php 
// Adding dynamic supports
function indexblogchallenge_theme_support(){
  add_theme_support('title-tag');
  add_theme_support('custom-logo');
  add_theme_support('post-thumbnails');
}

add_action('after_setup_theme','indexblogchallenge_theme_support');

// Adding menus
function indexblogchallenge_menus() {
  $locations = array(
    'primary' => 'Indexblogchallenge Desktop Primary Left Sidebar',
    'footer' => 'Indexblogchallenge Footer Menu Items'
  );

  register_nav_menus($locations);
}

add_action('init', 'indexblogchallenge_menus');

// Function to enqueue my files
function indexblogchallenge_register_styles() {

  $styleVersion = wp_get_theme()->get('Version');
  wp_enqueue_style('indexblogchallenge-styles', get_template_directory_uri() . "/style.css", array('indexblogchallenge-bootstrap'), $styleVersion, 'all');
  wp_enqueue_style('indexblogchallenge-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', array(), '4.4.1', 'all');
  wp_enqueue_style('indexblogchallenge-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css', array(), '5.13.0', 'all');

}
add_action('wp_enqueue_scripts', 'indexblogchallenge_register_styles');

// Function to register my scripts
function indexblogchallenge_register_scripts() {

  wp_enqueue_script('indexblogchallenge-jquery', 'https://code.jquery.com/jquery-3.4.1.slim.min.js', array(), '3.4.1', true);
  wp_enqueue_script('indexblogchallenge-popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array(), '1.16.0', true);
  wp_enqueue_script('indexblogchallenge-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array(), '4.4.1', true);
  wp_enqueue_script('indexblogchallenge-main', get_template_directory_uri() . "/assets/js/main.js", array(), '1.0', true);

}
add_action('wp_enqueue_scripts', 'indexblogchallenge_register_scripts');

function indexblogchallenge_widget_areas() {

  register_sidebar(
    array(
      'before_title' => '',
      'after_title' => '',
      'before_widget' => '',
      'after_widget' => '',
      'name' => 'Sidebar Area',
      'id' => 'sidebar-1',
      'description' => 'Sidebar Widget Area'
    )
  );

  register_sidebar(
    array(
      'before_title' => '',
      'after_title' => '',
      'before_widget' => '',
      'after_widget' => '',
      'name' => 'Footer Area',
      'id' => 'footer-1',
      'description' => 'Footer Widget Area'
    )
  );

}

add_action('widgets_init', 'indexblogchallenge_widget_areas');

// DB Connection

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $err_msgs = array();

  // VALIDATE FIRST NAME
  if(isset($_POST['userFirstName']) && !empty(trim($_POST['userFirstName']))) {
    $first_name = trim($_POST['userFirstName']);
    if (strlen($first_name) > 50){
      $err_msgs[] = $first_name_error = "Sorry, the first name is too long!";
    }
  } else {
    $err_msgs[] = $first_name_error = "Please add your First Name.";
  }

  // VALIDATE LAST NAME
  if(isset($_POST['userLastName']) && !empty(trim($_POST['userLastName']))) {
    $last_name = trim($_POST['userLastName']);
    if (strlen($last_name) > 50){
      $err_msgs[] = $last_name_error = "Sorry, the last name is too long!";
    }
  } else {
    $err_msgs[] = $last_name_error = "Please add your Last Name.";
  }

  // VALIDATE EMAIL
  if(isset($_POST['userEmail']) && !empty(trim($_POST['userEmail']))) {
    $email = trim($_POST['userEmail']);
    if (strlen($email) > 128){
      $err_msgs[] = $email_error = "Sorry, the email address is too long!";
    }
  } else {
    $err_msgs[] = $email_error = "Please add your email.";
  }

  // VALIDATE PHONE
  if(isset($_POST['userPhoneNumber']) && !empty(trim($_POST['userPhoneNumber']))) {
    $phone = trim($_POST['userPhoneNumber']);
    if (strlen($phone) > 20){
      $err_msgs[] = $phone_error = "Sorry, the phone is too long!";
    }
  } else {
    $err_msgs[] = $phone_error = "Please add your phone number.";
  }

  // VALIDATE MESSAGE
  if(isset($_POST['userMessage']) && !empty(trim($_POST['userMessage']))) {
    $message = trim($_POST['userMessage']);
    if (strlen($message) > 200){
      $err_msgs[] = $message_error = "Sorry, your message is way too long!";
    }
  } else {
    $err_msgs[] = $message_error = "Please add a message.";
  }

  // SUBMIT
  if((count($err_msgs) == 0)) {
    global $wpdb;
    $data_array = array($first_name,$last_name,$email,$phone,$message);
    $table_name = 'indexblogchallenge_contact';
    
    $rowResult = $wpdb->insert($table_name, ['first_name' => $first_name,'last_name' => $last_name, 'email' => $email,'phone' => $phone,'message' => $message], $format=null);
    if ($rowResult == 1) {
      $user_info = $wpdb->get_row("SELECT first_name, last_name, email, phone FROM indexblogchallenge_contact WHERE email = '$email'", ARRAY_A);
      if ($user_info) {
        
        $user_message = 'Hello ' . $user_info['first_name'] . ' ' . $user_info['last_name'] . ', thank you for sendind this message. We will reach you out through the provided email [' . $user_info['email'] . '] or your phone [' . $user_info['phone'] . '].';

      } 
    } 
    $_POST = array();
  }

}

?>