<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['signinEdit'])) {
        $pid = $_POST['pidLogin'];
        $date = $_POST['dateLogin'];
        $class = $_POST['class'];

      
        if (empty($pid)) {
            $_SESSION['error'] = 'กรุณากรอกเลขรหัสประชาชน';
            header("location: signinEdit");
        } else if (empty($date)) {
            $_SESSION['error'] = 'กรุณากรอกเลขประจำตัวนักเรียน';
            header("location: signinEdit");
        } else if (empty($class)) {
            $_SESSION['error'] = 'กรุณาเลือกชั้นมัธยมปีที่สมัคร';
            header("location: signinEdit");
        } else {
            try {
            if($class == "4"){
                $check_data = $conn->prepare("SELECT * FROM m4 WHERE pid = :pid");
                $check_data->bindParam(":pid", $pid);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {

                    if ($pid == $row['pid']) {
                        if ($date == $row['date']) {
                            if($row['stat']!='2' && $row['stat']!='3'){
                                if ($row['urole'] == 'admin') {
                                    $_SESSION['admin_login'] = $row['id'];
                                    header("location: admin");
                                }else {
                                    $query = array(
                                        'id' => $row['id'], 
                                        'class' => $_POST['class']
                                        );
                                    
                                    $query = http_build_query($query);
                                    header("Location: signinEdit?$query");
                                }
                            }else {
                                $_SESSION['error'] = 'สถานะ "ข้อมูลถูกต้อง" หรือ "มีเลขประจำตัวสอบแล้ว" ไม่สามารถแก้ไขข้อมูลได้';
                                header("location: signinEdit");
                            }
                        } else {
                            $_SESSION['error'] = 'เลขวันเกิดผิด';
                            header("location: signinEdit");
                        }
                    } else {
                        $_SESSION['error'] = 'เลขบัตรประชาชนผิด';
                        header("location: signinEdit");
                    }
                } else {
                    $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                    header("location: signinEdit");
                }
            }
            else if($class == "1"){
                $check_data = $conn->prepare("SELECT * FROM m1 WHERE pid = :pid");
                $check_data->bindParam(":pid", $pid);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {

                    if ($pid == $row['pid']) {
                        if ($date == $row['date']) {
                            if($row['stat']!='2' && $row['stat']!='3'){
                                if ($row['urole'] == 'staff') {
                                    $_SESSION['staff_login'] = $row['id'];
                                    header("location: admin");
                                }else {
                                    $query = array(
                                        'id' => $row['id'], 
                                        'class' => $_POST['class']
                                        );
                                    
                                    $query = http_build_query($query);
                                    header("Location: signinEdit?$query");
                                }
                            }else {
                                $_SESSION['error'] = 'สถานะ "ข้อมูลถูกต้อง" หรือ "มีเลขประจำตัวสอบแล้ว" ไม่สามารถแก้ไขข้อมูลได้';
                                header("location: signinEdit");
                            }
                        } else {
                            $_SESSION['error'] = 'เลขวันเกิดผิด';
                            header("location: signinEdit");
                        }
                    } else {
                        $_SESSION['error'] = 'เลขบัตรประชาชนผิด';
                        header("location: signinEdit");
                    }
                } else {
                    $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                    header("location: signinEdit");
                }

            }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>