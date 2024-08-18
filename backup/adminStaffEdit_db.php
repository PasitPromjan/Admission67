<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])&&!isset($_SESSION['staff_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin.php');
    }

?>

<?php

    if(isset($_POST['update']))
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $stid = $_POST['stid'];
        $pid = $_POST['pid'];
        $id = $_POST['id'];


        $user_id = $_SESSION['user_login'];
        $sql = $conn->prepare("UPDATE users SET   firstname = :firstname, lastname = :lastname,stid =:stid,pid = :pid WHERE id = :id");
        $sql->bindParam(":firstname", $firstname);
        $sql->bindParam(":lastname", $lastname);
        $sql->bindParam(":stid", $stid);
        $sql->bindParam(":pid", $pid);
        $sql->bindParam(":id", $id);
        $sql->execute();

        if($sql){
            header("location:adminStaffData.php");
        }
    }

?>