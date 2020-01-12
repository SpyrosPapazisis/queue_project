<?php

include 'connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    $pdo = OpenCon();

    switch($_POST['type']){

        case "Citizen":
        case "Organisation":
            $name = $_POST['name'];
            break;
            
        case "Anonymous":
            $name = "Anonymous";
            break;
    }

    //echo $name;

    $sql = "INSERT INTO Customers (type, name, service, queued_time)
        VALUES(:type, :name, :service, :time)";

    $data = array(
        ':type' => $_POST['type'] ? $_POST['type'] : '',
        ':name' => $name ? $name : '',
        ':service' => $_POST['service'] ? $_POST['service'] : '',
        ':time' => date('Y-m-d H:i:s')
    );

    $insert = $pdo->prepare($sql);
    $insert->execute($data);


    $select = $pdo->prepare("SELECT MAX(id) AS id FROM `Customers` LIMIT 1");
    $select->execute();
    $data = $select->fetch(PDO::FETCH_ASSOC);

    echo json_encode($data);

}else {
    echo 'POST request failed';
}

?>