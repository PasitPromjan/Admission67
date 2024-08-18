<?php

session_start();
    require_once 'config/db.php';
        if(isset($_POST['pid'])) {
            $pid = $_POST['pid'];
            
            $check_person = $conn->prepare("SELECT pid FROM m4 WHERE pid = :pid");
                $check_person->bindParam(":pid", $pid);
                $check_person->execute();
                $userExists = $check_person->fetchColumn();

                $stmt = $pdo->prepare('SELECT COUNT(*) FROM m4 WHERE pid = ?');
                $stmt->execute([$pid]);
                $userExists = $stmt->fetchColumn();
        
            // ถ้า pid มีอยู่แล้ว
            if($userExists) {
                echo 'exists';
            } else {
                echo 'not_exists';
            }
        }
?>