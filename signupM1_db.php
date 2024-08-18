<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color: #910000;">
    
</body>
</html>
<?php 
    session_start();
    require_once 'config/db.php';
        if(isset($_POST['pid'])) {
            $pid = $_POST['pid'];
            
            // สร้างคำสั่ง SQL ในการตรวจสอบ pid
            $sql = "SELECT COUNT(*) FROM m1 WHERE pid = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $pid);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();
        
            // ถ้า pid มีอยู่แล้ว
            if($count > 0) {
                echo 'exists';
            } else {
                echo 'not_exists';
            }
        }
        

        $stat = '0';
        $title = $_POST['title'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $pid = $_POST['pid'];
        $StPN = $_POST['StPN'];
        $PaFirstname = $_POST['PaFirstname'];
        $PaLastname = $_POST['PaLastname'];
        $PaPN = $_POST['PaPN'];

        $oldschool = $_POST['oldschool'];
        $OS_Province = $_POST['OS_Province'];
        $address = $_POST['address'];
        $AD_Province = $_POST['AD_Province'];
        $AD_Subdistrict = $_POST['AD_Subdistrict'];
        $AD_District = $_POST['AD_District'];
        $date = $_POST['date'];
        $urole = 'user';
        $p1 = $_POST['p1'];
        $p2 = $_POST['p2'];
        $p3 = $_POST['p3'];
       
        $img = $_FILES['img'];
        $allow = array('jpg', 'jpeg', 'png','pdf','bmp');
        $extension = explode('.', $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;
        $filePath = 'uploads/'.$fileNew;

        $img_page1 = $_FILES['img_page1'];
        $allow1 = array('jpg', 'jpeg', 'png','pdf','bmp');
        $extension1 = explode('.', $img_page1['name']);
        $fileActExt1 = strtolower(end($extension1));
        $fileNew1 = rand() . "." . $fileActExt1;
        $filePath1 = 'uploads/'.$fileNew1;

        $img_page2 = $_FILES['img_page2'];
        $allow2 = array('jpg', 'jpeg', 'png','pdf','bmp');
        $extension2 = explode('.', $img_page2['name']);
        $fileActExt2 = strtolower(end($extension2));
        $fileNew2 = rand() . "." . $fileActExt2;
        $filePath2 = 'uploads/'.$fileNew2;

        $img_page3 = $_FILES['img_page3'];
        $allow3 = array('jpg', 'jpeg', 'png','pdf','bmp');
        $extension3 = explode('.', $img_page3['name']);
        $fileActExt3 = strtolower(end($extension3));
        $fileNew3 = rand() . "." . $fileActExt3;
        $filePath3 = 'uploads/'.$fileNew3;

            try {

                $check_person = $conn->prepare("SELECT pid FROM m1 WHERE pid = :pid");
                $check_person->bindParam(":pid", $pid);
                $check_person->execute();
                $userExists = $check_person->fetchColumn();

                $stmt = $pdo->prepare('SELECT COUNT(*) FROM m1 WHERE pid = ?');
                $stmt->execute([$pid]);
                $userExists = $stmt->fetchColumn();

                if ($userExists) {
                    echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'ผิดพลาด',
                            text: 'เลขประชาชนนี้มีการสมัครแล้ว',
                            icon: 'question'
                            
                            });
                    })
                    </script>";
                    header("refresh:2; url=signupM1");
                } else if (!isset($_SESSION['error'])) {
                    if (in_array($fileActExt, $allow) && in_array($fileActExt1, $allow1) && in_array($fileActExt2, $allow2) && in_array($fileActExt3, $allow3)) {
                        if (($img['size'] > 0 && $img['error'] == 0) && ($img_page1['size'] > 0 && $img_page1['error'] == 0) && ($img_page2['size'] > 0 && $img_page2['error'] == 0) && ($img_page3['size'] > 0 && $img_page3['error'] == 0)) {
                            if (move_uploaded_file($img_page3['tmp_name'], $filePath3)) {
                                if (move_uploaded_file($img_page2['tmp_name'], $filePath2)) {
                                    if (move_uploaded_file($img_page1['tmp_name'], $filePath1)) {
                                        if (move_uploaded_file($img['tmp_name'], $filePath)) {
                                                $stmt = $conn->prepare("INSERT INTO m1(stat, title, firstname, lastname, pid, StPN, PaFirstname, PaLastname, PaPN, urole, img, img_page1, img_page2, img_page3, oldschool, OS_Province, address, AD_Province, AD_Subdistrict ,AD_District, date, p1 ,p2, p3) 
                                                                        VALUES(:stat, :title, :firstname, :lastname, :pid, :StPN, :PaFirstname, :PaLastname, :PaPN, :urole, :img, :img_page1, :img_page2, :img_page3, :oldschool, :OS_Province, :address, :AD_Province, :AD_Subdistrict ,:AD_District, :date, :p1, :p2, :p3 )");
                                                $stmt->bindParam(":stat", $stat);
                                                $stmt->bindParam(":title", $title);
                                                $stmt->bindParam(":firstname", $firstname);
                                                $stmt->bindParam(":lastname", $lastname);
                                                $stmt->bindParam(":pid", $pid);
                                                $stmt->bindParam(":StPN", $StPN);
                                                $stmt->bindParam(":PaFirstname", $PaFirstname);
                                                $stmt->bindParam(":PaLastname", $PaLastname);
                                                $stmt->bindParam(":PaPN", $PaPN);
                                                
                                                $stmt->bindParam(":oldschool", $oldschool);
                                                $stmt->bindParam(":OS_Province", $OS_Province);
                                                $stmt->bindParam(":address", $address);
                                                $stmt->bindParam(":AD_Province", $AD_Province);
                                                $stmt->bindParam(":AD_Subdistrict", $AD_Subdistrict);
                                                $stmt->bindParam(":AD_District", $AD_District);
                                                $stmt->bindParam(":date", $date);
                                                $stmt->bindParam(":p1", $p1);
                                                $stmt->bindParam(":p2", $p2);
                                                $stmt->bindParam(":p3", $p3);

                                                $stmt->bindParam(":urole", $urole);
                                                $stmt->bindParam(":img_page3", $fileNew3);
                                                $stmt->bindParam(":img_page2", $fileNew2);
                                                $stmt->bindParam(":img_page1", $fileNew1);
                                                $stmt->bindParam(":img", $fileNew);
                                                $stmt->execute();
                                                
                                                echo "<script>
                                                    $(document).ready(function() {
                                                        Swal.fire({
                                                            title: 'บันทึกข้อมูลการสมัครเรียบร้อยแล้ว',
                                                            text: 'ให้นักเรียนเข้ามาตรวจสอบผลการสมัคร ในช่วงเวลาที่เปิดรับสมัคร',
                                                            icon: 'success',
                                                            timer: 500000,
                                                            showConfirmButton: true
                                                        });
                                                    })
                                                    </script>";
                                                    header("refresh:2; url=index");
                                                    //header("location: signupM1");
                                        }else {
                                            $_SESSION['error'] = "ผิดพลาด ไฟล์ขนาดเกินที่จำกัด";
                                            header("location: signupM1");
                                        }
                                    }else {
                                        $_SESSION['error'] = "ผิดพลาด ไฟล์ขนาดเกินที่จำกัด";
                                        header("location: signupM1");
                                    }
                                }else {
                                    $_SESSION['error'] = "ผิดพลาด ไฟล์ขนาดเกินที่จำกัด";
                                    header("location: signupM1");
                                }
                            }else {
                                $_SESSION['error'] = "ผิดพลาด ไฟล์ขนาดเกินที่จำกัด";
                                header("location: signupM1");
                            }
                        }else {
                            $_SESSION['error'] = "ผิดพลาด ไฟล์ขนาดเกินที่จำกัด";
                            header("location: signupM1");
                        }
                    }else {
                        $_SESSION['error'] = "ผิดพลาด ไฟล์ขนาดเกินที่จำกัด";
                        header("location: signupM1");
                    }
                                    
                }else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: signupM1");
                }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    

?>