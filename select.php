<?php


include 'connect.php';

$pdo = OpenCon();


$sql = "SELECT * FROM `Customers` ORDER BY queued_time ASC";

$select = $pdo->prepare($sql);
$select->execute();

$data = $select->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);

?>
