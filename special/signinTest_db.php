<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['signin'])) {
        $pid = $_POST['pid'];
        $date = $_POST['date'];
        $class = $_POST['class'];

      
        if (empty($pid)) {
            $_SESSION['error'] = 'กรุณากรอกเลขรหัสประชาชน';
            header("location: signinTest");
        } else if (empty($date)) {
            $_SESSION['error'] = 'กรุณากรอกเลขประจำตัวนักเรียน';
            header("location: signinTest");
        } else if (empty($class)) {
            $_SESSION['error'] = 'กรุณาเลือกชั้นมัธยมปีที่สมัคร';
            header("location: signinTest");
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
                            if ($row['urole'] == 'admin') {
                                $_SESSION['admin_login'] = $row['id'];
                                header("location: admin");
                            }else {
                                $query = array(
                                    'id' => $row['id'], 
                                    'class' => $_POST['class']
                                    );
                                
                                $query = http_build_query($query);
                                header("Location: print?$query");
                            }
                        } else {
                            $_SESSION['error'] = 'เลขประจำตัวนักเรียนผิด';
                            header("location: signinTest");
                        }
                    } else {
                        $_SESSION['error'] = 'เลขบัตรประชาชนผิด';
                        header("location: signinTest");
                    }
                } else {
                    $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                    header("location: signinTest");
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
                            if($row['stat'] == '3'){
                                if ($row['urole'] == 'staff') {
                                    $_SESSION['staff_login'] = $row['id'];
                                    header("location: admin");
                                }else {
                                    $query = array(
                                        'id' => $row['id'], 
                                        'class' => $_POST['class']
                                        );
                                    
                                    $query = http_build_query($query);
                                    header("Location: print?$query");
                                }
                            }   else {
                                $_SESSION['error'] = 'ยังไม่ผ่านการตรวจสอบ หรือ ยังไม่ออกเลขที่นั่งสอบ';
                                header("location: signinTest");
                            }
                        } else {
                            $_SESSION['error'] = 'เลขประจำตัวนักเรียนผิด';
                            header("location: signinTest");
                        }
                    } else {
                        $_SESSION['error'] = 'เลขบัตรประชาชนผิด';
                        header("location: signinTest");
                    }
                } else {
                    $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                    header("location: signinTest");
                }

            }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>