<?php
if (isset($_GET['assessmentID']) && isset($_GET['RoleForMark'])) {
    $assessmentID = $_GET['assessmentID'];
    $RoleForMark = $_GET['RoleForMark'];

    if ($RoleForMark == "Company") {
        header("Location: viewCompanyEvaluation.php?id=$assessmentID");
        exit();
    } elseif ($RoleForMark == "Supervisor") {
        header("Location: viewLectureEvaluation.php?id=$assessmentID");
        exit();
    }
}
