<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['signin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

      
        if (empty($username)) {
            $_SESSION['error'] = 'กรุณากรอกเลขรหัสประชาชน';
            header("location: admin.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกเลขประจำตัวนักเรียน';
            header("location: admin.php");
        }else {
            try {
                
                $check_data = $conn->prepare("SELECT * FROM admins WHERE username = :username");
                $check_data->bindParam(":username", $username);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {

                    if ($username == $row['username']) {
                        if ($password == $row['password']) {
                            if ($row['urole'] == 'admin') {
                                $_SESSION['admin_login'] = $row['id'];
                                header("location: admin67.php");
                            }
                            if ($row['urole'] == 'staff') {
                                $_SESSION['staff_login'] = $row['id'];
                                header("location: admin67.php");
                            }
                        } else {
                            $_SESSION['error'] = 'เลขประจำตัวนักเรียนผิด';
                            header("location: admin.php");
                        }
                    } else {
                        $_SESSION['error'] = 'เลขบัตรประชาชนผิด';
                        header("location: admin.php");
                    }
                } else {
                    $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                    header("location: admin.php");
                }
            
            

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>