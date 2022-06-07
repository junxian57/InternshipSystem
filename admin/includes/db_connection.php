<?php
function OpenCon()
{
    $dbhost = "sql444.main-hosting.eu";
    $dbuser = "u928796707_group34";
    $dbpass = "u1VF3KYO1r|";
    $db = "u928796707_internshipWeb";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);

    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}
