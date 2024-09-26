<?php 
    if (session_status() == PHP_SESSION_NONE) {
    session_start();}?>

<!DOCTYPE html>
<html>
<head>
<?php require_once ('headFoot/header.php')?>
<title>ChocoLux</title>

</head>

<body class="sub_page">
<div class="form">
  <div class="main_body_content">

    <div class="hero_area">
      <!-- header section strats -->
      <?php require_once('headFoot/nac.php')?>



    </div>
        <h2>Vous n'etes pas autorisé a acceder à cette page</h2>
       
    

    </div>
    </div>

  <!-- footer section -->
  <?php require_once('headFoot/footer.php'); ?>
  <!-- footer section -->

</body>
</html>