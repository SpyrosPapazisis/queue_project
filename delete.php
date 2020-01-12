<?php


include 'connect.php';

$pdo = OpenCon();

$id = $_POST['id']; 
if( isset( $_POST['id'] ) && is_numeric( $_POST['id'] ) && $_POST['id'] > 0 ) {
    $sql = "DELETE FROM Customers WHERE id = :id";

    $data = [':id' => $id];

    $delete = $pdo->prepare($sql);

    $delete->execute($data);

    echo 'everyting went well row = ' . $delete->rowCount() . ' and id = ' . $id;

}else {
    echo "ID must be a positive integer";
}