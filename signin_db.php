<?php 

session_start();
require_once 'config/db.php';

if (isset($_POST['signin'])) {
    $pid = $_POST['pid'];
    $date = $_POST['date'];
    $class = $_POST['class'];
    $response = array('success' => false, 'error' => '');

    if (empty($pid)) {
        $response['error'] = 'กรุณากรอกเลขรหัสประชาชน';
    } else if (empty($date)) {
        $response['error'] = 'กรุณากรอกเลขประจำตัวนักเรียน';
    } else if (empty($class)) {
        $response['error'] = 'กรุณาเลือกชั้นมัธยมปีที่สมัคร';
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
                                $response['success'] = true;
                                $response['redirect'] = 'admin';
                            } else {
                                $query = array('id' => $row['id'], 'class' => $_POST['class']);
                                $query = http_build_query($query);
                                $response['success'] = true;
                                $response['redirect'] = "signin?$query";
                            }
                        } else {
                            $response['error'] = 'เลขประจำตัวนักเรียนผิด';
                        }
                    } else {
                        $response['error'] = 'เลขบัตรประชาชนผิด';
                    }
                } else {
                    $response['error'] = "ไม่มีข้อมูลในระบบ";
                }
            } else if($class == "1"){
                $check_data = $conn->prepare("SELECT * FROM m1 WHERE pid = :pid");
                $check_data->bindParam(":pid", $pid);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {
                    if ($pid == $row['pid']) {
                        if ($date == $row['date']) {
                            if ($row['urole'] == 'staff') {
                                $_SESSION['staff_login'] = $row['id'];
                                $response['success'] = true;
                                $response['redirect'] = 'admin';
                            } else {
                                $query = array('id' => $row['id'], 'class' => $_POST['class']);
                                $query = http_build_query($query);
                                $response['success'] = true;
                                $response['redirect'] = "signin?$query";
                            }
                        } else {
                            $response['error'] = 'เลขประจำตัวนักเรียนผิด';
                        }
                    } else {
                        $response['error'] = 'เลขบัตรประชาชนผิด';
                    }
                } else {
                    $response['error'] = "ไม่มีข้อมูลในระบบ";
                }
            }

        } catch(PDOException $e) {
            $response['error'] = $e->getMessage();
        }
    }
    
    echo json_encode($response);
}

?>