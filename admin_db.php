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
                            if (isset($_SESSION['admin_login'])) {
                                unset($_SESSION['admin_login']);
                            }
                            if (isset($_SESSION['staff_login'])) {
                                unset($_SESSION['staff_login']);
                            }
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

    if (isset($_POST['addannounce'])) {
        $description = $_POST['description'];
        $link = $_FILES['link'];
    
        $allow = array('jpg', 'jpeg', 'png', 'pdf');
        $extension = explode('.', $link['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;   
        $filePath = 'link/' . $fileNew;
    
        if (in_array($fileActExt, $allow)) {
            if ($link['size'] > 0 && $link['error'] == 0) {
                if (move_uploaded_file($link['tmp_name'], $filePath)) {
                    $sql = $conn->prepare("INSERT INTO announce(description, link) VALUES(:description, :link)");
                    $sql->bindParam(":description", $description);
                    $sql->bindParam(":link", $fileNew);
                    $sql->execute();
                    if($sql){
                        header("location: admin67.php");
                    }
                } else {
                    echo "Failed to move uploaded file.";
                }
            } else {
                echo "File upload error.";
            }
        } else {
            echo "File type not allowed.";
        }
    }

    if (isset($_POST['editannounce'])) {
        $id = $_POST['id'];
        $description = $_POST['description'];
        $link = $_FILES['link'];

        if ($link['name']) {
            $allow = array('jpg', 'jpeg', 'png', 'pdf');
            $extension = explode('.', $link['name']);
            $fileActExt = strtolower(end($extension));
            $fileNew = rand() . "." . $fileActExt;   
            $filePath = 'link/' . $fileNew;

            if (in_array($fileActExt, $allow)) {
                if ($link['size'] > 0 && $link['error'] == 0) {
                    if (move_uploaded_file($link['tmp_name'], $filePath)) {
                        $fileNew = $fileNew;
                    } else {
                        echo "Failed to move uploaded file.";
                    }
                } else {
                    echo "File upload error.";
                }
            } else {
                echo "File type not allowed.";
            }
        } else {
            $fileNew = $_POST['oldlink']; // ใช้ลิงก์เดิมถ้าไม่มีการอัปโหลดไฟล์ใหม่
        }

        $sql = $conn->prepare("UPDATE announce SET description = :description, link = :link WHERE id = :id");
        $sql->bindParam(":description", $description);
        $sql->bindParam(":link", $fileNew);
        $sql->bindParam(":id", $id);
        $sql->execute();
        if($sql){
            header("location: admin67.php");
        }
    }

?>