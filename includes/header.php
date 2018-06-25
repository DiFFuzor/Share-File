<?php session_start() ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Share File</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
  <header class="row align-items-center justify-content-center justify-content-sm-between m-0 px-5">
    <a href="index.php" class="logo text-uppercase m-0">Share file</a>
    <div class="login">
      <?php
        if ( isset($_SESSION['login']) )
        {
          echo '<a href="account.php" class="user_header d-inline-block mr-3">'.$_SESSION['login'].'</a>';
          echo '<a href="account.php"><button class="button_exit text-uppercase">My account</button></a>';
          echo '<a href="upload.php"><button class="button_exit text-uppercase">Upload File</button></a>';
          echo '<a href="includes/sessionDestroy.php"><button class="button_exit text-uppercase">log out</button></a>';
        }
        else
        {
          echo '<button class="button_sign_in text-uppercase">sign in</button>';
          echo '<button class="button_registration text-uppercase ">Registration</button>';
        }
      ?>
    </div>
  </header>
  <section class="container">
    <div class="content row justify-content-center align-items-center">