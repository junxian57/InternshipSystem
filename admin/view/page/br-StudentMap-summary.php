<?php
  if (!isset($_SESSION['adminID'])) {
    if (!isset($_SESSION['committeeID'])) {
      echo "<script>
          alert('You are not permitted to enter this page.\\nPlease login as an administrator/ITP Committee.');
          window.location.href = 'adminLogin.php';
      </script>";
    }
  }
  
  if(!isset($_POST['student']) && !isset($_POST['lecture'])) {
    echo '<script> alert("Error Occurred, Please Try Again"); </script>';
    header('Location: ../../br-StudentSupervisor-Map.php');
  }
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="../../js/jquery-1.11.1.min.js"></script>
    
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mapping Summary</title>
  </head>
  <style>
    *{
      font-family: "Roboto Condensed", sans-serif;
    }

    body{
      margin: 50px 20px 100px 20px;
      background-color: #fefefe;
    }

    .flex-row{
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;
      max-width: fit-content;
      margin: 30px auto;
    }

    .page-title{
      font-size: 2rem;
      font-weight: 700;
      margin: 0 auto;
      width: fit-content;
      text-align: center;
      text-decoration: underline;
      text-decoration-color: #313e85;
    }

    .section-title{
      font-size: 1.5rem;
      font-weight: 700;
      color: #ff4500;
      text-align: center;
    }

    .section-title{
      margin-top: 30px;
    }

    @media screen and (max-width: 1020px){
      .flex-row{
        flex-direction: column;
      }
    }

    table{
       min-width: 350px;
       
    }
      
    .dataTables_wrapper{
      border: 1px solid black;
      padding-bottom: 10px;
    }

    .arrow-icon{
      margin-left: 60px;
      margin-right: 60px;
      font-size: 2em;
      color: #ff4500;
    }

    table .odd{
      background-color: #e7e4e4 !important;
    }

    th{
      background-color: #eee;
    }

    hr{
      color: black;
    }

  </style>
  <body>
    <div class="page-title">Mapping Summary</div>
    <div class="section-title">Lecturer</div>
    <div class="flex-row">
      <table class="summary-table">
        <!-- <div class="section-title">Before</div> -->
        <thead>
            <tr>
                <th>Name</th>
                <th>Fulfilled / Max</th>
            </tr>
        </thead>
        <tbody class="tab3-small-table" id="tab3-summary-table">
          <?php
            $lecture = json_decode($_POST['lecture']);
            foreach($lecture as $lecturer){
              echo '<tr>';
              echo '<td>'.$lecturer->lecName.'</td>';
              echo '<td>'.($lecturer->maxSlot - $lecturer->beforeCount).' / '.$lecturer->maxSlot.'</td>';
              echo '</tr>';
              //print_r($lecturer);
            }
          ?>
        </tbody>
      </table>
      <div class="space"><span class="arrow-icon">&#129050</span></div>

      <table class="summary-table margin-left-50">
        <!-- <div class="section-title">After</div> -->
        <thead>
            <tr>
                <th>Name</th>
                <th>Fulfilled / Max</th>
            </tr>
        </thead>
        <tbody class="tab3-small-table" id="tab3-summary-table">
          <?php
              foreach($lecture as $lecturer){
                echo '<tr>';
                echo '<td>'.$lecturer->lecName.'</td>';
                echo '<td>'.($lecturer->maxSlot - $lecturer->slotCount).' / '.$lecturer->maxSlot.'</td>';
                echo '</tr>';
              }
          ?>
        </tbody>
      </table>
    </div>
<hr>
    <div class="section-title second-title">Tutorial Group</div>
    <div class="flex-row">
      <table class="summary-table">
        <thead>
            <tr>
                <th>Prog / Year / Tutorial</th>
                <th>Left / Total</th>
            </tr>
        </thead>
        <tbody class="tab3-small-table" id="tab3-summary-table">
          <?php
          $studentGroup = json_decode($_POST['student']);
                foreach($studentGroup as $tutorial){
                  echo '<tr>';
                  echo '<td>'.$tutorial->programme.' / '.$tutorial->year.' / '.$tutorial->tutorialGroup.'</td>';
                  echo '<td>'.$tutorial->noselectstudent.' / '.$tutorial->maxStudent.'</td>';
                  echo '</tr>';
                }
            ?>
        </tbody>
      </table>
      <div class="space"><span class="arrow-icon">&#129050</span></div>
      <table class="summary-table">
        <thead>
            <tr>
                <th>Prog / Year / Tutorial</th>
                <th>Left / Total</th>
            </tr>
        </thead>
        <tbody class="tab3-small-table" id="tab3-summary-table">
          <?php
              foreach($studentGroup as $tutorial){
                echo '<tr>';
                echo '<td>'.$tutorial->programme.' / '.$tutorial->year.' / '.$tutorial->tutorialGroup.'</td>';
                echo '<td>'.$tutorial->studentCount.' / '.$tutorial->maxStudent.'</td>';
                echo '</tr>';
              }
          ?>
        </tbody>
      </table>
    </div>
  </body>

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>


  $(document).ready(function() {
    $('.summary-table').DataTable({
      "dom": 'lrtp',
      "searching": false,
      "bLengthChange": false,
      "info": false,
      "ordering": false,
      "pageLength": 15,
      "columnDefs": [
        {"className": "dt-center", "targets": "_all"}
      ]
    });
  });

  arrow = document.getElementsByClassName('arrow-icon');

  //Change arrow icon while resize
  window.addEventListener('resize', function(){
    Array.from(arrow).forEach(element => {
      window.innerWidth < 1020 ? element.innerHTML = '&#11015' : element.innerHTML = '&#129050';
      element.parentNode.style.marginTop = '10px';
      element.parentNode.style.marginBottom = '10px';
    });
  });
</script>
</html>
