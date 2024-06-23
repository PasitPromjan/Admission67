<?php 

    session_start();
    require_once 'config/db.php';

    $pid = $_POST['pid'];

    $check_person = $conn->prepare("SELECT pid FROM users WHERE pid = :pid");
                $check_person->bindParam(":pid", $pid);
                $check_person->execute();
                $row = $check_person->fetch(PDO::FETCH_ASSOC);

    echo $pid.'-'.$row['pid'].'-';
?>