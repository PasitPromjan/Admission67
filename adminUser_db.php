<?php 

    session_start();

    require_once "config/db.php";

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $classed = $_POST['classed'];

        $stat = $_POST['stat'];
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
            $allow = array('jpg', 'jpeg', 'png');
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
            $allow1 = array('jpg', 'jpeg', 'png');
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
            $allow2 = array('jpg', 'jpeg', 'png');
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

        $img_page3 = $_FILES['img_page3'];
        $img_page32 = $_POST['img_page32'];
        $upload3 = $_FILES['img_page3']['name'];
        if ($upload3 != '') {
            $allow3 = array('jpg', 'jpeg', 'png','pdf');
            $extension3 = explode('.', $img_page3['name']);
            $fileActExt3 = strtolower(end($extension3));
            $fileNew3 = rand() . "." . $fileActExt3;  // rand function create the rand number 
            $filePath3 = 'uploads/'.$fileNew3;

            if (in_array($fileActExt3, $allow3)) {
                if ($img_page3['size'] > 0 && $img_page3['error'] == 0) {
                   move_uploaded_file($img_page3['tmp_name'], $filePath3);
                }
            }
        } else {
            $fileNew3 = $img_page32;
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

            $sql = $conn->prepare("UPDATE m1 SET p1= :p1, p2= :p2, p3=:p3,title= :title, firstname =:firstname, lastname =:lastname, pid= :pid, StPN= :StPN, PaFirstname= :PaFirstname, PaLastname= :PaLastname, PaPN= :PaPN, img =:img, img_page1= :img_page1, img_page2= :img_page2, img_page3= :img_page3, oldschool= :oldschool, OS_Province= :OS_Province, address= :address, AD_Province= :AD_Province, AD_Subdistrict =:AD_Subdistrict, AD_District= :AD_District, date= :date WHERE id = :id");
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

            $sql->bindParam(":img_page3", $fileNew3);
            $sql->bindParam(":img_page2", $fileNew2);
            $sql->bindParam(":img_page1", $fileNew1);
            $sql->bindParam(":img", $fileNew);
            $sql->execute();

            if ($sql) {
                if($stat == 0 ){
                    header("location: adminM1Stat0?class=$classed");
                }
                else if($stat == 1 ){
                    header("location: adminM1Stat1?class=$classed");
                }
                else{
                    header("location: adminM1Stat2?class=$classed");
                }
            } else {
                echo "<script>
                    $(document).ready(function() {
                    Swal.fire({
                        title: 'แก้ไขไม่สำเร็จ',
                        icon: 'error',
                        timer: 500000,
                        showConfirmButton: true
                    });
                })
                </script>";
                header("refresh:2; url=admin67");
            }
        }
        else if($classed == "4"){
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
            $p5 = $_POST['p5'];
            if($p5 == 0){
                $p5 = $_POST['p5_old'];
            }
            $p6 = $_POST['p6'];
            if($p6 == 0){
                $p6 = $_POST['p6_old'];
            }
            $p7 = $_POST['p7'];
            if($p7 == 0){
                $p7 = $_POST['p7_old'];
            }
            $p8 = $_POST['p8'];
            if($p8 == 0){
                $p8 = $_POST['p8_old'];
            }
            $p4 = $_POST['p4'];
            if($p4 == 0){
                $p4 = $_POST['p4_old'];
            }
            $p9 = $_POST['p9'];
            if($p9 == 0){
                $p9 = $_POST['p9_old'];
            }
            $p10 = $_POST['p10'];
            if($p10 == 0){
                $p10 = $_POST['p10_old'];
            }
            $p11 = $_POST['p11'];
            if($p11 == 0){
                $p11 = $_POST['p11_old'];
            }
            $p12 = $_POST['p12'];
            if($p12 == 0){
                $p12 = $_POST['p12_old'];
            }
            $sql = $conn->prepare("UPDATE m4 SET p1= :p1, p2= :p2, p3=:p3,p4= :p4, p5= :p5, p6=:p6,p7= :p7, p8= :p8, p9=:p9,p10= :p10, p11= :p11, p12=:p12,title= :title, firstname =:firstname, lastname =:lastname, pid= :pid, StPN= :StPN, PaFirstname= :PaFirstname, PaLastname= :PaLastname, PaPN= :PaPN, img =:img, img_page1= :img_page1, img_page2= :img_page2, img_page3= :img_page3, oldschool= :oldschool, OS_Province= :OS_Province, address= :address, AD_Province= :AD_Province, AD_Subdistrict =:AD_Subdistrict, AD_District= :AD_District, date= :date WHERE id = :id");
            $sql->bindParam(":id", $id);
            $sql->bindParam(":p1", $p1);
            $sql->bindParam(":p2", $p2);
            $sql->bindParam(":p3", $p3);
            $sql->bindParam(":p4", $p4);
            $sql->bindParam(":p5", $p5);
            $sql->bindParam(":p6", $p6);
            $sql->bindParam(":p7", $p7);
            $sql->bindParam(":p8", $p8);
            $sql->bindParam(":p9", $p9);
            $sql->bindParam(":p10", $p10);
            $sql->bindParam(":p11", $p11);
            $sql->bindParam(":p12", $p12);
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

            $sql->bindParam(":img_page3", $fileNew3);
            $sql->bindParam(":img_page2", $fileNew2);
            $sql->bindParam(":img_page1", $fileNew1);
            $sql->bindParam(":img", $fileNew);
            $sql->execute();

            if ($sql) {
                if($stat == 0 ){
                    header("location: adminM1Stat0?class=$classed");
                }
                else if($stat == 1 ){
                    header("location: adminM1Stat1?class=$classed");
                }
                else{
                    header("location: adminM1Stat2?class=$classed");
                }
            } else {
                echo "<script>
                    $(document).ready(function() {
                    Swal.fire({
                        title: 'แก้ไขไม่สำเร็จ',
                        icon: 'error',
                        timer: 500000,
                        showConfirmButton: true
                    });
                })
                </script>";
                header("refresh:2; url=admin67");
            }
        }
    }

?>