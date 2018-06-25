<?php include 'includes/header.php' ?>

<div class="account">


  <?php
    if ( !empty($_SESSION['auth']) and $_SESSION['auth'] )
    {
  ?>

      <form class="col-sm-5" method="POST" enctype="multipart/form-data">
        <input id="user-file" type="file" name="user-file">
        <label for="user-file">
          <p class="w-100 mb-0" style="font-size: 12px">The upload file must be no more than 10MB</p>
        </label>
        <input class="button_upload text-uppercase" type="submit" value="upload file">
      </form>

  <?php
      include 'script_upload.php';
    }
    else
    {
      header ('location: index.php'); // если пользователь не авторизован - перебрасываем на index
    }

  ?>

</div>

<?php include 'includes/footer.php' ?>
