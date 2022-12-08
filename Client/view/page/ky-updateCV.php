<?php
    session_start();
    if(isset($_SESSION['studentloggedin']) && $_SESSION['studentloggedin']==true){
       $adminloggedin= true;
       $studentID = $_SESSION['studentID'];
    }
    //$studentID = '22REI00002';
?>

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
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/dataTables.bootstrap.css" />
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
    <link rel="stylesheet" href="../../scss/ky-updateCV.css">
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('../../includes/sidebar.php'); ?>
        <?php include_once('../../includes/header.php'); ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <form action="ky-manageUpdateCV.php" method="post">
                    
                        <h3 class="page-title">Update student CV</h3>

                        <input type="hidden" name="stdID" value="<?php echo $studentID ?>">

                        <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                            <!-- Tab Button -->
                            <div class="tab">
                                <button class="tablinks tab1" onclick="changeTab(event, 'EnteringCVDetails')" id='defaultOpen'>Update CV by entering CV details </button>
                                <button class="tablinks tab2" onclick="changeTab(event, 'uploadingCV')">Update CV by uploading CV</button> 
                            </div>
                            
                            <div class="wrapper">
                                
                                 <!-- Tab Content 1-->
                                <div id="EnteringCVDetails" class="tabcontent">
                                    <div class="title" style="margin-top:20px;">
                                        <h2 class="title-4">CV Details</h2>
                                    </div>

                                    <div class="horizon-wrap">
                                        <div class="input-style name-address-group width-100">
                                        <label for="cmpAddress">Career objectives :</label>
                                        <input type="text" style="width: 100%;" placeholder="Career objectives" name="objectives" required>
                                        </div>
                                    </div>

                                    <div class="horizon-wrap">
                                        <div class="input-style name-address-group width-100">
                                        <label for="cmpAddress">Work Experience :</label>
                                        <input type="text" style="width: 100%;" placeholder="Work Experience" name="workExperience" required >
                                        </div>
                                    </div>

                                    <div class="horizon-wrap">
                                        <div class="input-style name-address-group width-100">
                                        <label for="cmpAddress">Skills :</label>
                                        <input type="text" style="width: 100%;" name="skill" placeholder="Skills" required></input>
                                        </div>
                                    </div>

                                    <div class="horizon-wrap">
                                        <div class="input-style name-address-group width-100">
                                        <label for="cmpAddress">Languages known :</label>
                                        <input type="text" style="width: 100%;" name="Language" placeholder="Languages" required></input>
                                        </div>
                                    </div>

                                    <div class="horizon-wrap">
                                        <div class="input-style name-address-group width-100">
                                        <label for="cmpAddress">Education :</label>
                                        <input type="text" style="width: 100%;" placeholder="Education" name="education" required>
                                        </div>
                                    </div>

                                    <div class="horizon-wrap">
                                        <div class="input-style name-address-group width-100">
                                        <label for="cmpAddress">School or University :</label>
                                        <input type="text" style="width: 100%;" placeholder="School or University" name="school" required> 
                                        </div>
                                    </div>

                                    <div class="horizon-wrap">
                                        <div class="input-style name-address-group width-100">
                                        <label for="cmpAddress">CGPA :</label>
                                        <input type="text" style="width: 100%;" placeholder="CGPA" name="cgpa" required>
                                        </div>
                                    </div>

                                    <div class="horizon-wrap">
                                        <div class="input-style name-address-group width-100">
                                        <label for="cmpAddress">Extracurricular activities :</label>
                                        <input type="text" style="width: 100%;" placeholder="Extracurricular activities" name="extraActivities" required>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="button-group">
                                        <button type = "submit" name="updateCV" class="clickable-btn Update">Update</button>
                                        <!--<a href="#" class="clickable-btn Export">Cancel</a>
                                        <button type = "submit" name="createCV" class="submit-btn">Create</button>-->
                                    </div>
                                </div>
                            </div>
                            </form>

                            <form action="ky-manageUpdateCV.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="stdID" value="<?php echo $studentID ?>">
                                <!-- Tab Content 2-->
                                <div class="wrapper">
                                    <div id="uploadingCV" class="tabcontent">
                                        <div class="upload-box">
                                            <img src="https://www.codingnepalweb.com/demos/resize-and-compress-image-javascript/upload-icon.svg" alt="">
                                            <div class="box">
                                                
                                                <input type="file" name="pdf_file" required>
                                                <button type="submit" name="uploadCV" style="background-color: #f2891f; color: #fff; border: 1px solid #f2891f;"> Upload</button>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                            
                </div>
                
            </div>
        </div>
    </div>
    <footer><?php include_once('../../includes/footer.php'); ?></footer>
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
    function searchInTable() {
        let input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("keyInput");
        filter = input.value;
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

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

<script>
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
    </script>
</script>