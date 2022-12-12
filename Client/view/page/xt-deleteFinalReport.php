<?php
  $host = "sql444.main-hosting.eu";
  $user = "u928796707_group34";
  $password = "u1VF3KYO1r|";
  $database = "u928796707_internshipWeb";
                                
  $conn = mysqli_connect($host, $user, $password, $database); 
  
  if(isset($_GET['finalReportID'])){       
    $finalReportID = $_GET['finalReportID'];        
    $delete_final = "DELETE FROM finalReport WHERE finalReportID='$finalReportID'";     
    $run_final = mysqli_query($conn, $delete_final);        
    if($run_final){            
      echo "<script>alert('Deleted successfully!')</script>";     
      echo "<script>window.open('xt-viewFinalReport.php','_self')</script>";
    }      
  }
?>