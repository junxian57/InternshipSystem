<?php
session_start();
error_reporting(0);
include "includes/db_connection.php";

/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	header('location:logout.php');
} else {

	if (isset($_POST['submit'])) {
		$sername = $_POST['sername'];
		$cost = $_POST['cost'];



		$query = mysqli_query($con, "insert into  tblservices(ServiceName,Cost) value('$sername','$cost')");
		if ($query) {
			echo "<script>alert('Service has been added.');</script>";
			echo "<script>window.location.href = 'add-services.php'</script>";
			$msg = "";
		} else {
			echo "<script>alert('Something Went Wrong. Please try again.');</script>";
		}
	}*/
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>ITP SYSTEM</title>
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="../../css/style.css" rel='stylesheet' type='text/css' />
    <link href="../../css/font-awesome.css" rel="stylesheet">
    <script src="../../js/jquery-1.11.1.min.js"></script>
    <script src="../../js/modernizr.custom.js"></script>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="../../js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <script src="../../js/metisMenu.min.js"></script>
    <script src="../../js/custom.js"></script>
    <link href="../../css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="../../scss/br-studentSupervisorMaintain.css">
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once "../../includes/sidebar.php"; ?>
        <?php include_once "../../includes/header.php"; ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="page-title">Student & Supervisor Mapping Maintenance</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">

                        <!-- Tab Button -->
                        <div class="tab">
                            <button class="tablinks" onclick="changeTab(event, 'updateSupervisorMap')" id='defaultOpen'>Update Student-Supervisor</button>
                            <button class="tablinks" onclick="changeTab(event, 'ViewSupervisorMap')">View Student-Supervisor</button>
                        </div>

                        <!-- Tab Content 1-->
                        <div id="updateSupervisorMap" class="tabcontent">
                            <div class="search-group">
                                <!--                                    
                                //TODO: Require AJAX method to display searched supervisor         
                                -->
                                <div class="form-group">
                                    <label for="curr-supervisor">Current Supervisor <span class="required-star">*</span></label>
                                    <input type="search" class="form-control" id="curr-supervisor" name="curr-supervisor" placeholder="Enter Supervisor ID or Name...." required="true">
                                    <div class="form-control result-box">
                                        <!--                                    
                                        //TODO: Javascript to display result box need to fix         
                                        -->
                                    </div>
                                </div>

                                <span class="arrow-icon">&#129050</span>

                                <!--                                    
                                //TODO: Select intern batch first only allow to select students group        
                                -->
                                <div class="form-group">
                                    <label for="new-supervisor">New Supervisor | Available Slot <span class="required-star">*</span></label>
                                    <select name="new-supervisor" id="new-supervisor" class="form-control" required="true">
                                        <option value="0">Select a New Supervisor</option>
                                        <option value="LEC1001">Pong Suk Fun | 24/24</option>
                                        <option value="LEC1002">Pong Suk Fun | 24/24</option>
                                        <option value="LEC1003">Pong Suk Fun | 24/24</option>
                                        <option value="LEC1004">Pong Suk Fun | 24/24</option>
                                    </select>
                                </div>
                            </div>

                            <div class="button-group">
                                <!--                                    
                                //TODO: onclick -> start retrieve student list and proceed mapping
                                -->
                                <button class="clickable-btn" onclick="">Search</button>
                                <input type="reset" class="clickable-btn" href="#" value="Reset Field" onclick="resetInput(document.getElementById('curr-supervisor'), document.getElementById('new-supervisor'))">
                            </div>
                            <hr>
                            <div class="info-group">
                                <p><span style="color:#313e85;">Current</span> Supervisor Available Slot: <span>24 / 24</span></p>
                                <span>|</span>
                                <p><span style="color:#f2891f;">New</span> Supervisor Available Slot: <span>24 / 24</span></p>
                            </div>
                            <hr>
                            <div class="table-title">
                                <p>Hint: Table Below Is Scrollable</p>
                                <h4>Result Table</h4>
                                <input type="search" id="keyInput-update" onkeyup="searchInTable(document.getElementById('update-table'), document.getElementById(this.id))" placeholder="Enter Student Name...">
                            </div>
                            <div class="orange-border">
                                <table id="update-table">
                                    <thead>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Faculty</th>
                                        <th>Student Name</th>
                                        <th>Supervisor</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" name="21WMR08523" id="21WMR08523" checked></td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>

                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="21WMR08523" id="21WMR08523" checked></td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Poi Han</td>
                                            <td>Pong Suk Fun</td>

                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="21WMR08523" id="21WMR08523" checked></td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Yan Ning</td>
                                            <td>Pong Suk Fun</td>

                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="21WMR08523" id="21WMR08523" checked></td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>

                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="21WMR08523" id="21WMR08523" checked></td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>

                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="21WMR08523" id="21WMR08523" checked></td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>

                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="21WMR08523" id="21WMR08523" checked></td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>

                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="21WMR08523" id="21WMR08523" checked></td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>

                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="21WMR08523" id="21WMR08523" checked></td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>

                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="21WMR08523" id="21WMR08523" checked></td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>

                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="21WMR08523" id="21WMR08523" checked></td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>

                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="21WMR08523" id="21WMR08523" checked></td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>

                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="21WMR08523" id="21WMR08523" checked></td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>

                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="21WMR08523" id="21WMR08523" checked></td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="update-group">
                                <!--                                    
                                //TODO: get all data from above and input into database
                                -->
                                <button class="grey-btn" href="#" disabled>Update Mapping</button>
                            </div>
                        </div>

                        <!-- Tab Content 2-->
                        <div id="ViewSupervisorMap" class="tabcontent">
                            <div class="search-group">

                                <div class="form-group">
                                    <label for="faculty">Faculty <span class="required-star">*</span></label>
                                    <select name="faculty" id="faculty" class="form-control" required="true">
                                        <option value="0">Select a Faculty</option>
                                        <option value="FAC001">FOCS</option>
                                        <option value="FAC001">FAFB</option>
                                        <option value="FAC001">FOCI</option>
                                        <option value="FAC001">FOCI</option>
                                    </select>
                                </div>

                                <!--                                    
                                //TODO: Require AJAX method to display searched supervisor         
                                -->
                                <div class="form-group">
                                    <label for="supervisor">Supervisor <span class="required-star">*</span></label>
                                    <input type="search" class="form-control" id="supervisor" name="supervisor" placeholder="Enter Supervisor ID or Name...." required="true">
                                    <div class="form-control result-box">
                                        <!--                                    
                                        //TODO: Javascript to display result box need to fix         
                                        -->
                                    </div>
                                </div>


                            </div>

                            <div class="button-group">
                                <!--                                    
                                //TODO: onclick -> start retrieve student list and proceed mapping
                                -->
                                <button class="clickable-btn" onclick="">Search</button>
                                <input type="reset" class="clickable-btn" href="#" value="Reset Field" onclick="resetInput(document.getElementById('supervisor'), document.getElementById('faculty'))">
                            </div>
                            <hr>
                            <div class="table-title">
                                <p>Hint: Table Below Is Scrollable</p>
                                <h4>Result Table</h4>
                                <input type="search" id="keyInput-remove" onkeyup="searchInTable(document.getElementById('remove-table'), document.getElementById(this.id))" placeholder="Enter Student Name...">
                            </div>
                            <div class="table-responsive orange-border">
                                <table id="remove-table">
                                    <thead>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Faculty</th>
                                        <th>Student Name</th>
                                        <th>Supervisor</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Poi Han</td>
                                            <td>Pong Suk Fun</td>
                                           <td class="btn-td">
                                            <div>
                                                <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Yan Ning</td>
                                            <td>Pong Suk Fun</td>
                                           <td class="btn-td">
                                                <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                           <td class="btn-td">
                                                <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Hui Xuan</td>
                                            <td>Pong Suk Fun</td>
                                           <td class="btn-td">
                                                <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                           <td class="btn-td">
                                                <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                           <td class="btn-td">
                                                <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                           <td class="btn-td">
                                                <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                           <td class="btn-td">
                                                <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                           <td class="btn-td">
                                                <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                           <td class="btn-td">
                                                <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                           <td class="btn-td">
                                                <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                           <td class="btn-td">
                                                <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                           <td class="btn-td">
                                                <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                           <td class="btn-td">
                                                <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer><?php include_once "../../includes/footer.php"; ?></footer>
</body>

<script src="../../js/classie.js"></script>
<script src="../../js/bootstrap.js"> </script>
<script>
    let menuLeft = document.getElementById('cbp-spmenu-s1'),
        showLeftPush = document.getElementById('showLeftPush'),
        body = document.body;

    showLeftPush.onclick = function() {
        classie.toggle(this, 'active');
        classie.toggle(body, 'cbp-spmenu-push-toright');
        classie.toggle(menuLeft, 'cbp-spmenu-open');
        disableOther('showLeftPush');
    };

    function disableOther(button) {
        if (button !== 'showLeftPush') {
            classie.toggle(showLeftPush, 'disabled');
        }
    }
</script>
<script>
    function searchInTable(tableID, inputID) {
        let input, filter, table, tr, td, i, txtValue;
        input = inputID;
        filter = input.value.toUpperCase();
        table = tableID;
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[3];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function changeTab(evt, tabName) {
        let i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.querySelectorAll(".tabcontent");
        tabcontent.forEach(i => {
            i.style.display = "none";
        });

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.querySelectorAll(".tablinks");
        tablinks.forEach(i => {
            i.classList.remove("active");
        });

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function resetInput(valueInput, selectionInput){
        valueInput.value = "";
        selectionInput.selectedIndex = "0";       
    }

</script>
<script>
    document.getElementById("defaultOpen").click();

    //Search Result on Search Bar
    function inputSearchResult() {
        const getSearchResultArr = document.getElementsByClassName('search-result');
        const getSearchBar = document.getElementById('searchBar');
        const getResultBox = document.querySelector('.result-box');

        if (getSearchResultArr.length > 0) {
            for (let i = 0; i < getSearchResultArr.length; i++) {
                getSearchResultArr[i].addEventListener('click', (btn) => {
                    getSearchBar.value = btn.target.innerText;
                    getResultBox.style.display = 'none';
                });
            }
        } else {
            return;
        }
    }

    function removeAllChildNodes(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }

    async function displaySearchResult() {
        const getResultBox = document.querySelector('.result-box');
        const respondResult = await searchBarData();
        let resultArr = [];

        if (respondResult === null || respondResult === undefined || respondResult.length == 0) {
            getResultBox.style.display = 'none';
            return;
        }
        //Clear the existing box
        removeAllChildNodes(getResultBox);

        if (respondResult !== null || respondResult !== undefined || respondResult.length != 0) {
            for (let i = 0; i < Object.keys(respondResult).length; i++) {
                resultArr[i] =
                    `<li class='search-result'>${respondResult[i].employeeID}: ${respondResult[i].fullName}</li>`;
            }
        } else {
            getResultBox.style.display = 'none';
            return;
        }

        getResultBox.style.display = 'block';
        getResultBox.innerHTML = resultArr.join('');
        inputSearchResult();
    }

    async function searchBarData() {
        const getSearchInput = document.getElementById('searchBar').value;
        const getResultBox = document.querySelector('.result-box');
        let url;

        if (getSearchInput == '') {
            getResultBox.style.display = 'none';
            return;
        } else {
            if (Number.isInteger(parseInt(getSearchInput))) {
                url = '../php-inc/ajaxSearchEmployee.php?icNo=' + getSearchInput;
            } else {
                url = '../php-inc/ajaxSearchEmployee.php?fullName=' + getSearchInput;
            }
            const response = await fetch(url);
            const data = await response.json();
            return data;
        }
    }
</script>


</html>