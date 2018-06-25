<?php
  include 'includes/connection.php';

  function generatePassKey() // Для шифрования пароля, создаем ключ
  {
    $passKey = '';
    $passKeyLength = 8; //длина ключа
    for($i=0; $i<$passKeyLength; $i++) {
      $passKey .= chr(mt_rand(33,126)); //символ из ASCII-table
    }
    return $passKey;
  }

  if ( !empty($_POST['user_pass_register']) and !empty($_POST['user_register']) ) //проверяем заполнение форм
  {
      $login = trim($_POST['user_register']);
      $login = strip_tags($login);
      $password = trim($_POST['user_pass_register']);
      
      $query = 'SELECT * FROM users WHERE login="'.$login.'"';
      $isFreeLogin = mysqli_fetch_assoc(mysqli_query($connection, $query));

      if ( empty($isFreeLogin) )  //проверяем занят ли логин
      {
        $passKey = generatePassKey();
        $encryptPassword = md5($password.$passKey); //шифруем пароль

        $query = 'INSERT INTO users SET login="'.$login.'", password="'.$encryptPassword.'", passkey="'.$passKey.'"';
        mysqli_query($connection, $query);

        header ('location: index.php?success=successRegistered'); //возвращаем с успешной регистрацией
      }
      else
      {
        header('location: index.php?error=loginExists'); //возвращаем с ошибкой занятого логина
      }
  }
  else
  {
    header('location: index.php?error=emptyField'); //возвращаем с ошибкой заполнения форм
  }

?>
