<?php
    session_start();
    require_once 'config/db.php';
    if(isset($_POST['allow']))
    {
        $comment ='';
        $stat = '2';
        $id = $_POST['id']; 
        $classed = $_POST['classed'];
        $checkby = $_POST['checkby']; 
        
        
        if ($classed == "1") {
            $sql = $conn->prepare("UPDATE m1 SET comment = :comment, stat = :stat,checkby= :checkby WHERE id = :id");            
        } else if ($classed == "4") {
            $sql = $conn->prepare("UPDATE m4 SET comment = :comment, stat = :stat,checkby= :checkby WHERE id = :id"); 
        }
        $sql->bindParam(":checkby", $checkby);
        $sql->bindParam(":id", $id);
        $sql->bindParam(":stat", $stat);
        $sql->bindParam(":comment", $comment);
        $sql->execute();


        if ($sql) {
        header("location:adminMboard.php?class=$classed&stat=0");
        exit(0);
      } else {
        echo "ไม่สามารถแก้ไขข้อมูลได้" . mysqli_error($conn);
      }
    }

    if(isset($_POST['unallow']))
    {
        $comment ='';
        $stat = '0';
        $id = $_POST['id']; 
        $classed = $_POST['classed'];
        $checkby = $_POST['checkby']; 
        
        
        if ($classed == "1") {
            $sql = $conn->prepare("UPDATE m1 SET comment = :comment, stat = :stat,checkby= :checkby WHERE id = :id");            
        } else if ($classed == "4") {
            $sql = $conn->prepare("UPDATE m4 SET comment = :comment, stat = :stat,checkby= :checkby WHERE id = :id"); 
        }
        $sql->bindParam(":checkby", $checkby);
        $sql->bindParam(":id", $id);
        $sql->bindParam(":stat", $stat);
        $sql->bindParam(":comment", $comment);
        $sql->execute();


        if ($sql) {
        header("location:adminMboard.php?class=$classed&stat=0");
        exit(0);
      } else {
        echo "ไม่สามารถแก้ไขข้อมูลได้" . mysqli_error($conn);
      }
    }

    

    if(isset($_POST['sentComment'])){
        $comment = $_POST['comment'];
        $stat = '1';
        $checkby = $_POST['checkby']; 
        $id = $_POST['id'];

        $classed = $_POST['classed'];
        
        
        if ($classed == "1") {
            $sql = $conn->prepare("UPDATE m1 SET comment = :comment, stat = :stat, checkby= :checkby WHERE id = :id");            
        } else if ($classed == "4") {
            $sql = $conn->prepare("UPDATE m4 SET comment = :comment, stat = :stat, checkby= :checkby WHERE id = :id"); 
        }
        $sql->bindParam(":checkby", $checkby);
        $sql->bindParam(":id", $id);
        $sql->bindParam(":stat", $stat);
        $sql->bindParam(":comment", $comment);
        $sql->execute();


        if ($sql) {
        header("location:adminMboard.php?class=$classed&stat=0");
        exit(0);
        } else {
        echo "ไม่สามารถแก้ไขข้อมูลได้" . mysqli_error($conn);
       }
    }


?>