<?php
  include 'includes/connection.php';

  if ( !empty($_POST['user_pass']) and !empty($_POST['user_login']) ) // проверяем заполнение форм / check the completion of forms
  {
    $login = trim($_POST['user_login']);
    $login = strip_tags($login);
    $password = trim($_POST['user_pass']);
    
    $query = 'SELECT * FROM users WHERE login="'.$login.'"';
    $user = mysqli_fetch_assoc(mysqli_query($connection, $query));

    if ( !empty($user) ) // проверяем наличие такого пользователя / check for the presence of such a user
    {
      $passKey = $user['passkey'];
      $encryptPassword = md5($password.$passKey); // шифруем пароль с ключем из базы / encrypt the password with a key from the database

      if ( $user['password'] == $encryptPassword ) // сравнивавем пароли с БД / compare the passwords with the database
      {
        session_start(); // запускаем сессию / start the session
        $_SESSION['auth'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['login'] = $user['login'];

        header ('location: account.php'); // переходим в личный кабинет / go to your account
      }
      else
      {
        header("location: index.php?error=incorrect");  // возвращаем неверный логин или пароль / return incorrect login or password
      }
    }
    else
    {
      header("location: index.php?error=notRegistered");  // возвращаем отсутствие такого логина / return the absence of such a login
    }
  }

?>