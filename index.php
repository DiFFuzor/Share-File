<?php
  include 'includes/header.php';

  If ( isset($_GET['error']) )
  {
    $error = $_GET['error'];
    If ( $error == 'loginExists' )
    {
      include 'includes/loginExists.php';
    }
    elseif ( $error == 'emptyField' )
    {
      include 'includes/emptyField.php';
    }
    elseif ( $error == 'incorrect' )
    {
      include 'includes/incorrect.php';
    }
    elseif ( $error == 'notRegistered' )
    {
      include 'includes/notRegistered.php';
    }
  }
  elseif ( isset($_GET['success'] ))
  {
    $success = $_GET['success'];
    if ( $success == 'successRegistered' )
    {
      include 'includes/successRegistered.php';
    }
  }
  else
  {
    include 'includes/welcome.php';
  }
?>
      <form id="login_form" name="login_form" action="script_login.php" method="post">
        <h3 class="text-uppercase text-center mb-4">Sign In</h3>
        <p>
          <label for="user_login">Email</label>
          <input type="email" id="user_login" name="user_login" value="">
        </p>
        <p>
          <label for="user_pass">Password</label>
          <input type="password" id="user_pass" name="user_pass" value="">
        </p>
        <p>
          <input class="button_login" type="submit" name="login" value="Sign In">
        </p>
      </form>

      <form id="register_form" name="register_form" action="script_register.php" method="post">
        <h3 class="text-uppercase text-center mb-4">Registration</h3>
        <p>
          <label for="user_register">Email</label>
          <input type="email" id="user_register" name="user_register" value="">
        </p>
        <p>
          <label for="user_pass_register">Password</label>
          <input type="password" id="user_pass_register" name="user_pass_register" value="">
        </p>
        <p>
          <input class="button_login" type="submit" name="register" value="Registration">
        </p>

      </form>

<?php include 'includes/footer.php' ?>