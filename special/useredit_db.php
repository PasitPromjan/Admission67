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

    require_once "config/db.php";

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $classed = $_POST['classed'];

        
        

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
        $date = $_POST['date'];

        $AD_Province = $_POST['AD_Province'];
        $AD_Subdistrict = $_POST['AD_Subdistrict'];
        $AD_District = $_POST['AD_District'];


        $img = $_FILES['img'];
        $img2 = $_POST['img2'];
        $upload = $_FILES['img']['name'];
        if ($upload != '') {
            $allow = array('jpg', 'jpeg', 'png','pdf');
            $extension = explode('.', $img['name']);
            $fileActExt = strtolower(end($extension));
            $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
            $filePath = 'uploads/'.$fileNew;

            if (in_array($fileActExt, $allow)) {
                if ($img['size'] > 0 && $img['error'] == 0) {
                   move_uploaded_file($img['tmp_name'], $filePath);
                }
            }
        } else {
            $fileNew = $img2;
        }

        $img_page1 = $_FILES['img_page1'];
        $img_page12 = $_POST['img_page12'];
        $upload1 = $_FILES['img_page1']['name'];
        if ($upload1 != '') {
            $allow1 = array('jpg', 'jpeg', 'png','pdf');
            $extension1 = explode('.', $img_page1['name']);
            $fileActExt1 = strtolower(end($extension1));
            $fileNew1 = rand() . "." . $fileActExt1;  // rand function create the rand number 
            $filePath1 = 'uploads/'.$fileNew1;

            if (in_array($fileActExt1, $allow1)) {
                if ($img_page1['size'] > 0 && $img_page1['error'] == 0) {
                   move_uploaded_file($img_page1['tmp_name'], $filePath1);
                }
            }
        } else {
            $fileNew1 = $img_page12;
        }

        $img_page2 = $_FILES['img_page2'];
        $img_page22 = $_POST['img_page22'];
        $upload2 = $_FILES['img_page2']['name'];
        if ($upload2 != '') {
            $allow2 = array('jpg', 'jpeg', 'png','pdf');
            $extension2 = explode('.', $img_page2['name']);
            $fileActExt2 = strtolower(end($extension2));
            $fileNew2 = rand() . "." . $fileActExt2;  // rand function create the rand number 
            $filePath2 = 'uploads/'.$fileNew2;

            if (in_array($fileActExt2, $allow2)) {
                if ($img_page2['size'] > 0 && $img_page2['error'] == 0) {
                   move_uploaded_file($img_page2['tmp_name'], $filePath2);
                }
            }
        } else {
            $fileNew2 = $img_page22;
        }
        

        if($classed == "1"){
            $p1 = $_POST['p1'];
            if($p1 == 0){
                $p1 = $_POST['p1_old'];
            }
            $p2 = $_POST['p2'];
            if($p2 == 0){
                $p2 = $_POST['p2_old'];
            }
            $p3 = $_POST['p3'];
            if($p3 == 0){
                $p3 = $_POST['p3_old'];
            }

            $sql = $conn->prepare("UPDATE m1 SET p1= :p1, p2= :p2, p3=:p3,title= :title, firstname =:firstname, lastname =:lastname, pid= :pid, StPN= :StPN, PaFirstname= :PaFirstname,edit_when = current_timestamp, PaLastname= :PaLastname, PaPN= :PaPN, img =:img, img_page1= :img_page1, img_page2= :img_page2, oldschool= :oldschool, OS_Province= :OS_Province, address= :address, AD_Province= :AD_Province, AD_Subdistrict =:AD_Subdistrict, AD_District= :AD_District, date= :date WHERE id = :id");
            $sql->bindParam(":id", $id);
            $sql->bindParam(":p1", $p1);
            $sql->bindParam(":p2", $p2);
            $sql->bindParam(":p3", $p3);
            $sql->bindParam(":title", $title);
            $sql->bindParam(":firstname", $firstname);
            $sql->bindParam(":lastname", $lastname);
            $sql->bindParam(":pid", $pid);
            $sql->bindParam(":StPN", $StPN);
            $sql->bindParam(":PaFirstname", $PaFirstname);
            $sql->bindParam(":PaLastname", $PaLastname);
            $sql->bindParam(":PaPN", $PaPN);
                                                                        
            $sql->bindParam(":oldschool", $oldschool);
            $sql->bindParam(":OS_Province", $OS_Province);
            $sql->bindParam(":address", $address);
            $sql->bindParam(":AD_Province", $AD_Province);
            $sql->bindParam(":AD_Subdistrict", $AD_Subdistrict);
            $sql->bindParam(":AD_District", $AD_District);
            $sql->bindParam(":date", $date);

            $sql->bindParam(":img_page2", $fileNew2);
            $sql->bindParam(":img_page1", $fileNew1);
            $sql->bindParam(":img", $fileNew);
            $sql->execute();

            if ($sql) {
                echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'แก้ไขเรียบร้อย',
                        icon: 'success',
                        timer: 50000,
                        showConfirmButton: true
                    });
                })
                </script>";
                header("refresh:2; url=index.php");
            } else {
                $query = array(
                    'id' => $id, 
                    'class' => $classed
                    );
                
                $query = http_build_query($query);
                $_SESSION['error'] = "ผิดพลาด กรุณาเช็คข้อมูลอีกครั้ง";
                header("location: signinEdit.php?$query");
            }
        }
        else if($classed == "4"){
            $sql = $conn->prepare("UPDATE m4 SET title= :title, firstname =:firstname, lastname =:lastname, pid= :pid, StPN= :StPN, PaFirstname= :PaFirstname, PaLastname= :PaLastname, PaPN= :PaPN, img =:img,edit_when = current_timestamp, img_page1= :img_page1, img_page2= :img_page2, oldschool= :oldschool, OS_Province= :OS_Province, address= :address, AD_Province= :AD_Province, AD_Subdistrict =:AD_Subdistrict, AD_District= :AD_District, date= :date WHERE id = :id");
            $sql->bindParam(":id", $id);
            $sql->bindParam(":title", $title);
            $sql->bindParam(":firstname", $firstname);
            $sql->bindParam(":lastname", $lastname);
            $sql->bindParam(":pid", $pid);
            $sql->bindParam(":StPN", $StPN);
            $sql->bindParam(":PaFirstname", $PaFirstname);
            $sql->bindParam(":PaLastname", $PaLastname);
            $sql->bindParam(":PaPN", $PaPN);
                                                                        
            $sql->bindParam(":oldschool", $oldschool);
            $sql->bindParam(":OS_Province", $OS_Province);
            $sql->bindParam(":address", $address);
            $sql->bindParam(":AD_Province", $AD_Province);
            $sql->bindParam(":AD_Subdistrict", $AD_Subdistrict);
            $sql->bindParam(":AD_District", $AD_District);
            $sql->bindParam(":date", $date);

            $sql->bindParam(":img_page2", $fileNew2);
            $sql->bindParam(":img_page1", $fileNew1);
            $sql->bindParam(":img", $fileNew);
            $sql->execute();

            if ($sql) {
                echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'แก้ไขเรียบร้อย',
                        icon: 'success',
                        timer: 50000,
                        showConfirmButton: true
                    });
                })
                </script>";
                header("refresh:2; url=index.php");
            } else {
                $query = array(
                    'id' => $id, 
                    'class' => $classed
                    );
                
                $query = http_build_query($query);
                $_SESSION['error'] = "ผิดพลาด กรุณาเช็คข้อมูลอีกครั้ง";
                header("location: signinEdit.php?$query");
            }
        }
    }

?>