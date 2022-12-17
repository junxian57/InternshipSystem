<?php 
    //include('../../includes/db_connection.php');
    $db = new DBController();
                                    
    $sql1 = "select * from Company"; 
    $result1 = $db->runQuery($sql1);

    if(count($result1) > 0){
    ?>    
        <table class="table" bordered="1">  
        <tr>  
                <th>Id</th>  
                <th>Name</th>
                <th>Date Added</th>
                <th>Email</th>
                <th>Contact number</th>
                <th>Company Contact Person</th>
                <th>Size</th>
                <th>Address</th>
                <th>State</th>  
                <th>City</th>  
                <th>Post Code</th>  
                <th>Field Area</th>
                <th>Company Internship Placement</th>
                <th>Status</th> 
                <th>Rating</th> 

        </tr>
        
    <?php
        foreach ($result1 as $company1) {
    ?>
            
            <tr>  
                <td><?php echo $company1['companyID']?></td>
                <td><?php echo $company1['cmpName']?></td>
                <td><?php echo $company1['cmpDateJoined']?></td>                   
                <td><?php echo $company1['cmpEmail']?></td>
                <td><?php echo $company1['cmpContactNumber']?></td>
                <td><?php echo $company1['cmpContactPerson']?></td>
                <td><?php echo $company1['cmpCompanySize']?></td>
                <td><?php echo $company1['cmpAddress']?></td> 
                <td><?php echo $company1['cmpState']?></td>
                <td><?php echo $company1['cmpCity']?></td>
                <td><?php echo $company1['cmpPostCode']?></td>
                <td><?php echo $company1['cmpFieldsArea']?></td>
                <td><?php echo $company1['cmpNumberOfInternshipPlacements']?></td>
                <td><?php echo $company1['cmpAccountStatus']?></td>
                <td><?php echo $company1['cmpRating']?></td>
            </tr>
            <?php
        }

    }    

?>