<?php 
    //include('../../includes/db_connection.php');
    $db = new DBController();
                                    
    $sql = "select * from Student"; 
    $result = $db->runQuery($sql);

    if(count($result) > 0){
    ?>    
        <table class="table" bordered="1">  
        <tr>  
            <th>Student Id</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th> 
            <th>Programme</th>
            <th>Lecturer</th>
            <th>Internship Batch Id</th>
            <th>Date Added</th>
            <th>Application Quota</th>
            <th>Current No of Application</th>
            <th>Account Status</th>
            <th>Tutorial Group</th>
        </tr>
        
    <?php
        foreach ($result as $student) {
    ?> 
            <tr>  
                <th><?php echo $student['studentID'] ?></th> 
                <th><?php echo $student['studName']?></th>
                <th><?php echo $student['studGender']?></th>
                <th><?php echo $student['studEmail']?></th>
                <th><?php echo $student['studContactNumber']?></th>
                <th><?php echo $student['studHomeAddress']?></th>
                <th><?php echo $student['programmeID']?></th>
                <th><?php echo $student['lecturerID']?></th>
                <th><?php echo $student['internshipBatchID']?></th>
                <th><?php echo $student['studDateJoined']?></th>
                <th><?php echo $student['studApplicationQuota']?></th>
                <th><?php echo $student['studCurrentNoOfApp']?></th>
                <th><?php echo $student['studAccountStatus']?></th>
                <th><?php echo $student['tutorialGroupNo']?></th>
            </tr>
            <?php
        }

    }    

?>