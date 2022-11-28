<?php
  $host = "sql444.main-hosting.eu";
  $user = "u928796707_group34";
  $password = "u1VF3KYO1r|";
  $database = "u928796707_internshipWeb";
                                
  $conn = mysqli_connect($host, $user, $password, $database); 
  
  if(isset($_GET['monthlyReportID'])){       
    $monthlyReportID = $_GET['monthlyReportID'];        
    $delete_month = "DELETE FROM weeklyReport WHERE monthlyReportID='$monthlyReportID'";     
    $run_month = mysqli_query($conn,$delete_month);        
    if($run_month){            
      echo "<script>alert('Deleted successfully!')</script>";     
      echo "<script>window.open('xt-viewWorkProgress.php','_self')</script>";
    }      
  }
?>