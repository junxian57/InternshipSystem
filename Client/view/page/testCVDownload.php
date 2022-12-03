<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Display PDF</title>
  </head>
  <body>
    <div class="div1">
    <?php
    
      include_once('../../includes/db_connection.php');
      $conn = new DBController();

      $sql="SELECT pdf from pdf ";

      $result = $conn->runQuery($sql);

      foreach($result as $s){
        $pdf = $s['pdf'];
    ?>
        <a href="../../app/BLL/downloadCV.php?path=<?php echo $pdf; ?>" download>Download</a>
    <?php
      }
    ?>

    </div>

  </body>
</html>

  