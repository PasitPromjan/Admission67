<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])&&!isset($_SESSION['staff_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin.php');
    }

?>

<?php
    include('config/connect.php');
    $sql = "SELECT * FROM provinces";
    $query = mysqli_query($connn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark">
<?php include 'adminHEADBAR.php';?>
  
    <div class="container-fluid">
        <div class="bg-light p-5 rounded">
            

            <main class="col py-3">
                <div class="container">
                <?php if (isset($_GET['id'])&&isset($_GET['class'])) {
                    
                    $class = $_GET['class'];
                    $id = $_GET['id'];
                    if($class == "4"){
                        $stmt = $conn->query("SELECT * FROM m4 WHERE id = $id");
                        $stmt->execute();
                    }
                    else if($class == "1"){
                        $stmt = $conn->query("SELECT * FROM m1 WHERE id = $id");
                        $stmt->execute();
                    }
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
            } ?>
            <?php if (isset($_GET['id'])&&isset($_GET['class'])) {  ?>
                <br>
                <h1>แก้ไขข้อมูล</h1>
            <hr>
            <form action="adminUser_db.php" method="post" enctype="multipart/form-data">
                   <div class='row'>
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <img src="uploads/<?php echo $row['img']; ?>" id="previewImg">
                                    <input value="<?php echo $row['img']; ?>" class="form-control" type="file" id="imgInput" name="img">
                                    <input type="hidden" value="<?php echo $row['img']; ?>"  class="form-control" name="img2" >
                                    <label for="imgInput" class="form-label" id="button">อัปโหลดรูป</label>
                                </div>
                                
                            </div>
                     </div>
                     <br>
                        <div class="row">
                            <h5 class='text-success'>ข้อมูลนักเรียน</h5>
                                <div class='col-md-2'>
                                    <div class='form-group'>
                                        <label for="title" class="col-form-label">คำนำหน้า</label>
                                        <select  name="title" class="form-control">
                                            <option <?php if($row['title']==''){ ?> selected <?php } ?> disabled value=""<?php echo " "; ?> "  ><?php echo " "; ?></option>
                                            <option value="นาย" <?php if($row['title']=='นาย'){ ?> selected <?php } ?>>นาย</option>
                                            <option value="นางสาว" <?php if($row['title']=='นางสาว'){ ?> selected <?php } ?>>นางสาว</option>
                                            <option value="เด็กชาย" <?php if($row['title']=='เด็กชาย'){ ?> selected <?php } ?>>เด็กชาย</option>
                                            <option value="เด็กหญิง" <?php if($row['title']=='เด็กหญิง'){ ?> selected <?php } ?>>เด็กหญิง</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='col-md-5'>
                                    <div class='form-group'>
                                        <label for="firstname" class="col-form-label">ชื่อ</label>
                                        <input type="text" value="<?php echo $row['firstname']; ?>" name="firstname" required class="form-control" name="firstname" >
                                        <input type="hidden" value="<?php echo $row['id']; ?>" name="id" required class="form-control" >
                                    </div>
                                </div>
                                <div class='col-md-5'>
                                    <div class='form-group'>
                                        <label for="lastname" class="col-form-label">นามสกุล</label>
                                        <input type="text" value="<?php echo $row['lastname']; ?>" name="lastname" required class="form-control" name="lastname">
                                    </div>
                                </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="datepicker2" class="form-label">วันเกิด</label>
                                <input id="datepicker2"  value="<?php echo $row['date']; ?>" width="276" name="date" />
                                <script>
                                    $('#datepicker2').datepicker({
                                        uiLibrary: 'bootstrap5'
                                    });
                                </script>
                            </div>
                            <div class="col-md-9">
                                <label for="pid" class="form-label">เลขบัตรประชาชน</label>
                                <input type='text'  name='pid' value="<?php echo $row['pid']; ?>" required class='form-control'>
                            </div>
                        <div>
                    
                    <label>เบอร์โทรศัพท์</label>
                    <input type='text' name='StPN' value="<?php echo $row['StPN']; ?>" required class='form-control'>
                    <br>
                    <hr>

                    <div class='row'>
                        <h5 class='text-success'>ข้อมูลผู้ปกครอง</h5>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label for="PaFirstname" class="col-form-label">ชื่อ</label>
                                    <input type="text" value="<?php echo $row['PaFirstname']; ?>" name="PaFirstname" required class="form-control" name="PaFirstname" >
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label for="PaLastname" class="col-form-label">นามสกุล</label>
                                    <input type="text" value="<?php echo $row['PaLastname']; ?>" name="PaLastname" required class="form-control" name="PaLastname">
                                </div>
                            </div>
                    </div>
                    <br>
                    <div class='row'>
                        <div class='form-group'>
                        <label>เบอร์โทรศัพท์</label>
                        <input type='text' value="<?php echo $row['PaPN']; ?>" name='PaPN' required class='form-control'>
                        </div>
                    </div>
                    <br>
                    <hr>

                    <div class="row">
                        <h5 class='text-success'>ข้อมูลโรงเรียน</h5>
                            <div class='form-group'>
                                <label for="oldschool" class="col-form-label">ชื่อโรงเรียน</label>
                                <input type="text" value="<?php echo $row['oldschool']; ?>" name="oldschool" required class="form-control" name="oldschool" >
                            </div>
                        <br>
                            <div class='form-group'>
                                <label for="OS_Province" class="col-form-label">จังหวัด</label>
                                <select name="OS_Province" class="form-control" >
                                    <!--<option value="<?php echo $data['p1'] ?> " SELECTED ><?php echo $data['p1'] ?></option>-->
                                <?php
                                        $OS = $row['OS_Province'];
                                        $prov = $conn->query("SELECT * FROM provinces WHERE id = $OS ");
                                        $prov ->execute();
                                        $re = $prov->fetch(PDO::FETCH_ASSOC)
                                ?>
                                <option value="<?=$row['OS_Province']?>"><?=$re['name_th']?></option>
                                <?php
                                    $spro = $conn->query("SELECT * FROM provinces ");
                                    while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                ?>              
                                <option value="<?=$c['id']?>"><?=$c['name_th']?></option>                     
                                <?php } ?>
                                                    
                                </select>
                            </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <h5 class='text-success'>ที่อยู่ตามทะเบียนบ้าน</h5>
                        <div class='form-group'>
                            <label for="address">ที่อยู่ (บ้านเลขที่ , ถนน , ซอย ,...)</label>
                            <input class="form-control " value="<?php echo $row['address']; ?>" name="address" id="address" ></input>
                            <br>
                        </div>
                        <br>
                        
                                <br><label for="province">จังหวัด</label>
                                    <?php
                                        $AD = $row['AD_Province'];
                                        $prov = $conn->query("SELECT * FROM provinces WHERE id = $AD ");
                                        $prov ->execute();
                                        $re = $prov->fetch(PDO::FETCH_ASSOC)
                                    ?>
                                <select name="AD_Province" id="province" class="form-control">
                                
                                        <option value="<?=$row['AD_Province']?>"><?=$re['name_th']?></option>
                                    <?php while($result = mysqli_fetch_assoc($query)): ?>
                                        <option value="<?=$result['id']?>"><?=$result['name_th']?></option>
                                    <?php endwhile; ?>
                                </select>
                                

                                <br><label for="amphure">อำเภอ</label>
                                    <?php
                                        $AD = $row['AD_Subdistrict'];
                                        $prov = $conn->query("SELECT * FROM amphures WHERE id = $AD ");
                                        $prov ->execute();
                                        $re = $prov->fetch(PDO::FETCH_ASSOC)
                                    ?>
                                <select name="AD_Subdistrict" id="amphure" class="form-control">
                                    <option value="<?=$row['AD_Subdistrict']?>"><?=$re['name_th']?></option>
                                    <option value="">เลือกอำเภอ</option>
                                </select>


                                <br><label for="district">ตำบล</label>
                                    <?php
                                        $AD = $row['AD_District'];
                                        $prov = $conn->query("SELECT * FROM districts WHERE id = $AD ");
                                        $prov ->execute();
                                        $re = $prov->fetch(PDO::FETCH_ASSOC)
                                    ?>
                                <select name="AD_District" id="district" class="form-control">
                                    <option value="<?=$row['AD_District']?>"><?=$re['name_th']?></option>
                                    <option value="">เลือกตำบล</option>
                                </select>

                    </div>
                    <br>
                    <hr>
                    <?php if($class== "4") {?>
                        <input type="hidden" value="4" name="classed" required class="form-control" >
                        <?php }?>
                    <?php if($class == "1"){ ?>
                        <input type="hidden" value="1" name="classed" required class="form-control" >
                                <br>
                                <div class="row">
                                    <h5 class='text-success'>แผนการเรียน</h5>
                                    <div class="col-md-7">
                                        <div class='form-group'>
                                            <label for="p1" class="col-form-label">แผนการเรียนอันดับที่ 1</label>
                                            <select name="p1" class="form-control" >
                                                <!--<option value="<?php echo $data['p1'] ?> " SELECTED ><?php echo $data['p1'] ?></option>-->
                                            <?php
                                                    $OS = $row['p1'];
                                                    $p = $conn->query("SELECT * FROM plan WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            <option selected disabled value="<?=$row['p1']?>"><?=$plann['planned']?></option>
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>              
                                            <option value="<?=$c['id']?>"><?=$c['planned']?></option>                     
                                            <?php } ?>
                                                                
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <label for="p2" class="col-form-label">แผนการเรียนอันดับที่ 2</label>
                                            <select name="p2" class="form-control" >
                                                <!--<option value="<?php echo $data['p2'] ?> " SELECTED ><?php echo $data['p2'] ?></option>-->
                                            <?php
                                                    $OS = $row['p2'];
                                                    $p = $conn->query("SELECT * FROM plan WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            <option selected disabled value="<?=$row['p2']?>"><?=$plann['planned']?></option>
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>              
                                            <option value="<?=$c['id']?>"><?=$c['planned']?></option>                     
                                            <?php } ?>
                                                                
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <label for="p3" class="col-form-label">แผนการเรียนอันดับที่ 3</label>
                                            <select name="p3" class="form-control" >
                                                <!--<option value="<?php echo $data['p3'] ?> " SELECTED ><?php echo $data['p3'] ?></option>-->
                                            <?php
                                                    $OS = $row['p3'];
                                                    $p = $conn->query("SELECT * FROM plan WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            <option selected disabled value="<?=$row['p3']?>"><?=$plann['planned']?></option>
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>              
                                            <option value="<?=$c['id']?>"><?=$c['planned']?></option>                     
                                            <?php } ?>
                                                                
                                            </select>
                                        </div> 
                                    </div>
                                </div>
                                <br>
                                <hr>
                            <?php } ?>

                    <div class="row ">
                        <h5 class='text-success'>หลักฐานประกอบการสมัคร</h5>
                        <div class="mb-3">
                            <label for="img2" class="form-label">ปพ 1 ด้านหน้า หรือใบรับรองผลการเรียน</label>
                            <h6>ไฟล์เดิม <a href="uploads/<?php echo $row['img_page1']; ?>" target="_blank"> <?php echo $row['img_page1']; ?></a></h6>
                            <input class="form-control" type="file"  id="img2" name="img_page1">
                            <input type="hidden" value="<?php echo $row['img_page1']; ?>" = class="form-control" name="img_page12" >
                        </div>
                        <div class="mb-3">
                            <label for="img3" class="form-label">ปพ 1 ด้านหลัง (ถ้าไม่มีให้ใช้ไฟล์เดียวกับ ปพ1 ด้านหน้า)</label>
                            <h6>ไฟล์เดิม <a href="uploads/<?php echo $row['img_page2']; ?>" target="_blank"> <?php echo $row['img_page2']; ?></a></h6>
                            <input class="form-control" type="file"  id="img3" name="img_page2">
                            <input type="hidden" value="<?php echo $row['img_page2']; ?>" = class="form-control" name="img_page22" >
                        </div>
                    </div>
                                
                    <hr>
                    <a href="user.php" class="btn btn-secondary">กลับหน้าหลัก</a>
                    <button type="submit" name="update" class="btn btn-primary">บันทึกข้อมูล</button>
            </form>

            <?php } ?>
                </div>
            </main>
        </div>
    </div>
    <script src="assets/jquery.min.js"></script>
    <script src="assets/script.js"></script>
    <script src="assets/tes.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    
    
    <script>
    let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file)
            }
        }
    </script>

    <script type="text/javascript">
        $(function() {
            $('#datepicker').datepicker();
        });
    </script>

</body>
</html>