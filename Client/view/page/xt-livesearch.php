<?php
  $host = "sql444.main-hosting.eu";
  $user = "u928796707_group34";
  $password = "u1VF3KYO1r|";
  $database = "u928796707_internshipWeb";
                              
  $conn = mysqli_connect($host, $user, $password, $database); 

  if(isset($_POST['input'])){
    $input = $_POST['input'];

    $query = "SELECT * FROM Company WHERE cmpName LIKE '{$input}%'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){?>

      <?php
        while($row = mysqli_fetch_assoc($result)){
          $cmpName = $row['cmpName'];
      ?>
      <ul id="list">
        <li id="clickedCmp"><?php echo $cmpName;?></li>
      </ul>

      <?php } ?>
      <?php
    }else{
      echo "<h6 class='text-danger text-center mt-3>No data found</h6>";
    }
  }
?>