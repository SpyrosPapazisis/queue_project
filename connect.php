<?php
function OpenCon() {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "root";
    $db = "queue_app";

    $dsn = "mysql:host=$dbhost;dbname=$db";

    $conn = new PDO($dsn, $dbuser, $dbpass) or die("Connect failed");

    return $conn;
}

function CloseCon($conn) {
    $conn->close();
}
?>