<?php

  session_start();
  session_destroy(); //убиваем сессию
  header('location: ../index.php'); //возвращаем на index

?>