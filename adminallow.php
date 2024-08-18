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
    <title>admin KP</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
            } 
            if (isset($_SESSION['admin_login'])) {
                $admin_id = $_SESSION['admin_login'];
                $stmt = $conn->query("SELECT * FROM admins WHERE id = $admin_id");
                $stmt->execute();
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            if (isset($_SESSION['staff_login'])) {
                $staff_id = $_SESSION['staff_login'];
                $stmt = $conn->query("SELECT * FROM admins WHERE id = $staff_id");
                $stmt->execute();
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            
            ?>
            <?php if (isset($_GET['id'])&&isset($_GET['class'])) {  ?>

            <form action="adminallow_db.php" method="post" enctype="multipart/form-data">    
                    <br>
                    <h1>ตรวจสอบข้อมูล</h1>
                    
                <hr>
                <?php if(  (isset($_SESSION['staff_login'])&&  ($row['stat']!='2' && $row['stat']!='3' )) ||  isset($_SESSION['admin_login'])  ) { ?>

                    <div class="row">
                    <div class="col-md-3">    <button onclick="return confirm('มั่นใจว่าข้อมูลผ่านใช่หรือไม่');" type="submit" name="allow" class="btn btn-primary">ผ่านการตรวจสอบ</button></div>
                    <?php if(isset($_SESSION['admin_login'])){ ?>
                        <div class="col-md-3">  <button onclick="return confirm('ตั้งสถานะข้อมูลเป็นรอการตรวจสอบ');" type="submit" name="unallow" class="btn btn-danger">ตั้งสถานะรอการตรวจสอบ</button></div>        
                        
                    
                        <?php } ?>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-1"><button type="submit" name="sentComment" class="btn btn-warning">ส่งการแก้ไข</button></div>
                        
                        <div class="col-md-4"><textarea class="form-control " name="comment" ></textarea></div>
                        <input type="hidden" value="<?php echo $class ?>" name="classed"  class="form-control" >
                        <input type="hidden" value="<?php echo $row['id'] ?>" name="id"  class="form-control" >
                        <input type="hidden" value="<?php echo $data['firstname']." ".$data['lastname']; ?>" name="checkby"  class="form-control" >
                        <?php if($row['comment']!=''){ ?>
                            <div class="col-md-4">
                            <h3 class="mt-4 text-danger"> <?php echo "แก้ไข :".$row['comment'] ?> </h3>
                            </div>
                        <?php }?>
                    </div>
                    
                <hr>
                <?php } ?>
                <br>
                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <img id="previewImg" src="uploads/<?php echo $row['img']; ?>">
                                        <div class='form-group'>
                                                <label for="sign_id" class="col-form-label text-secondary">เลขที่สมัคร</label>
                                                <h5><?php echo $row['sign_id']; ?></h5>
                                            </div><hr>
                                           
                                    </div>
                                    <div class="col-md-8">
                                        
                                        <div class="row">
                                            <h5 class='text-success'>หลักฐาน</h5>
                                            <div class="col-md-4">
                                                <label for="img_page1" class="col-form-label text-secondary">ปพ 1 ด้านหน้า หรือใบรับรองผลการเรียน</label>
                                                <h5><a href="uploads/<?php echo $row['img_page1']; ?>" target="_blank"><?php echo $row['img_page1']; ?></a></h5><hr class="new">
                                                
                                            </div>
                                            <div class="col-md-4">
                                                <label for="img_page2" class="col-form-label text-secondary">ปพ 1 ด้านหลัง</label>
                                                <h5><a href="uploads/<?php echo $row['img_page2']; ?>" target="_blank"><?php echo $row['img_page2']; ?></a></h5><hr class="new">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="img_page3" class="col-form-label text-secondary">สำเนาทะเบียนบ้าน</label>
                                                <h5><a href="uploads/<?php echo $row['img_page3']; ?>" target="_blank"><?php echo $row['img_page3']; ?></a></h5><hr class="new">
                                            </div>
                                        </div>
                                    </div>
                    </div>
                    <br>
                    <hr>
                    
                            
                                    <div class='row'>
                                        <h5 class='text-success'>ข้อมูลนักเรียน</h5>
                                        <div class='col-md-2'>
                                            <div class='form-group'>
                                                <label for="title" class="col-form-label text-secondary">คำนำหน้า</label>
                                                <h5><?php echo $row['title']; ?></h5>
                                            </div><hr class="new">
                                        </div>
                                        <div class='col-md-5'>
                                            <div class='form-group'>
                                                <label for="firstname" class="col-form-label text-secondary">ชื่อ </label>
                                                <h5><?php echo $row['firstname']; ?></h5>
                                            </div><hr class="new">
                                        </div>
                                        <div class='col-md-5'>
                                            <div class='form-group'>
                                                <label for="lastname" class="col-form-label text-secondary">นามสกุล</label>
                                                <h5><?php echo $row['lastname']; ?></h5>
                                            </div><hr class="new">
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label  for="pid" class="col-form-label text-secondary">เลขบัตรประชาชน</label>
                                                <h5><?php echo $row['pid']; ?></h5><hr class="new">
                                            </div>
                                        </div>    
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label for="date" class="col-form-label text-secondary">วันเกิด</label>
                                                <h5><?php echo $row['date']; ?></h5><hr class="new">
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label for="StPN" class="col-form-label text-secondary">เบอร์โทรศัพท์</label>
                                                <h5><?php echo $row['StPN']; ?></h5><hr class="new">
                                            </div>
                                        </div>
                                    </div>    
                                    
                                    <br>
                                    <br>
                                    <div class='row'>
                                        <h5 class='text-success'>ข้อมูลผู้ปกครอง</h5>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label for="PaFirstname" class="col-form-label text-secondary">ชื่อ</label>
                                                <h5><?php echo $row['PaFirstname']; ?></h5><hr class="new">
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label for="PaLastname" class="col-form-label text-secondary">นามสกุล</label>
                                                <h5><?php echo $row['PaLastname']; ?></h5><hr class="new">
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            
                                            <div class='form-group'>
                                                <label for="PaPN" class="col-form-label text-secondary">เบอร์โทรศัพท์</label>
                                                <h5><?php echo $row['PaPN']; ?></h5><hr class="new">
                                            </div>
                                        </div>
                                    </div>    
                            
                        <br>                
                        <br>
                        <div class="row">
                                <h5 class='text-success'>ข้อมูลโรงเรียน</h5>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label for="oldschool" class="col-form-label text-secondary">ชื่อโรงเรียน</label>
                                        <h5><?php echo $row['oldschool']; ?></h5><hr class="new">
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label for="OS_Province" class="col-form-label text-secondary">จังหวัด</label>
                                        <?php
                                            include("config/db.php");
                                            $prov = $conn->query("SELECT * FROM provinces ");
                                            while ($result = $prov->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                        <h5><?php if( $result['id']== $row['OS_Province']){echo $result['name_th'];} ?></h5>
                                        <?php } ?><hr class="new">
                                    </div>
                                </div>
                        </div>
                        <br>
                        <br>
                        
                        <div class="row">
                            <h5 class='text-success'>ที่อยู่ตามทะเบียนบ้าน</h5>
                            <div class='col-md-7'>
                                <div class='form-group'>
                                    <label for="address" class="col-form-label text-secondary">ที่อยู่</label>
                                    <h5><?php echo $row['address']; ?></h5><hr class="new">
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="row">
                                <div class="col-md-4">
                                    <label for="AD_Province" class="col-form-label text-secondary">จังหวัด</label>
                                    <?php
                                        include("config/db.php");
                                        $prov = $conn->query("SELECT * FROM provinces ");
                                        while ($result = $prov->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                    <h5><?php if( $result['id']== $row['AD_Province']){echo $result['name_th'];} ?></h5>
                                    <?php } ?><hr class="new">
                                </div>
                                <div class="col-md-4">
                                    <label for="AD_Subdistrict" class="col-form-label text-secondary">อำเภอ</label>
                                    <?php
                                        include("config/db.php");
                                        $prov = $conn->query("SELECT * FROM amphures ");
                                        while ($result = $prov->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <h5><?php if( $result['id']== $row['AD_Subdistrict']){echo $result['name_th'];} ?></h5>
                                    <?php } ?><hr class="new">
                                </div>
                                <div class="col-md-4">
                                    <label for="AD_District" class="col-form-label text-secondary">ตำบล</label>
                                    <?php
                                        include("config/db.php");
                                        $prov = $conn->query("SELECT * FROM districts ");
                                        while ($result = $prov->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <h5><?php if( $result['id']== $row['AD_District']){echo $result['name_th'];} ?></h5>
                                    <?php } ?><hr class="new">
                                </div>
                            </div>
                            <?php if($class == "1"){ ?>
                                <br>
                                <br>
                                <div class="row">
                                    <h5 class='text-success'>แผนการเรียน</h5>
                                    <div class="col-md-7">
                                        <div class='form-group'>
                                            <label for="p1" class="col-form-label text-secondary">แผนการเรียนอันดับที่ 1</label>
                                            <?php
                                                include("config/db.php");
                                                $p = $conn->query("SELECT * FROM plan1 ");
                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <h5><?php if( $plann['id']== $row['p1']){echo $plann['planned'];} ?></h5>
                                            <?php } ?><hr class="new">
                                        </div>
                                        <div class='form-group'>
                                            <label for="p2" class="col-form-label text-secondary">แผนการเรียนอันดับที่ 2</label>
                                            <?php
                                                include("config/db.php");
                                                $p = $conn->query("SELECT * FROM plan1 ");
                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <h5><?php if( $plann['id']== $row['p2']){echo $plann['planned'];} ?></h5>
                                            <?php } ?><hr class="new">
                                        </div>
                                        <div class='form-group'>
                                            <label for="p3" class="col-form-label text-secondary">แผนการเรียนอันดับที่ 3</label>
                                            <?php
                                                include("config/db.php");
                                                $p = $conn->query("SELECT * FROM plan1 ");
                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <h5><?php if( $plann['id']== $row['p3']){echo $plann['planned'];} ?></h5>
                                            <?php } ?><hr class="new">
                                        </div>  
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if($class == "4"){ ?>
                                <br>
                                <br>
                                <div class="row">
                                    <h5 class='text-success'>แผนการเรียน</h5>
                                    <div class="col-md-7">
                                        <div class='form-group'>
                                            <label for="p1" class="col-form-label text-secondary">แผนการเรียนอันดับที่ 1</label>
                                            <?php
                                                include("config/db.php");
                                                $p = $conn->query("SELECT * FROM plan4 ");
                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <h5><?php if( $plann['id']== $row['p1']){echo $plann['planned'];} ?></h5>
                                            <?php } ?><hr class="new">
                                        </div>
                                        <div class='form-group'>
                                            <label for="p2" class="col-form-label text-secondary">แผนการเรียนอันดับที่ 2</label>
                                            <?php
                                                include("config/db.php");
                                                $p = $conn->query("SELECT * FROM plan4 ");
                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <h5><?php if( $plann['id']== $row['p2']){echo $plann['planned'];} ?></h5>
                                            <?php } ?><hr class="new">
                                        </div>
                                        <div class='form-group'>
                                            <label for="p3" class="col-form-label text-secondary">แผนการเรียนอันดับที่ 3</label>
                                            <?php
                                                include("config/db.php");
                                                $p = $conn->query("SELECT * FROM plan4 ");
                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <h5><?php if( $plann['id']== $row['p3']){echo $plann['planned'];} ?></h5>
                                            <?php } ?><hr class="new">
                                        </div>
                                        <div class='form-group'>
                                            <label for="p4" class="col-form-label text-secondary">แผนการเรียนอันดับที่ 4</label>
                                            <?php
                                                include("config/db.php");
                                                $p = $conn->query("SELECT * FROM plan4 ");
                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <h5><?php if( $plann['id']== $row['p4']){echo $plann['planned'];} ?></h5>
                                            <?php } ?><hr class="new">
                                        </div>  
                                        <div class='form-group'>
                                            <label for="p5" class="col-form-label text-secondary">แผนการเรียนอันดับที่ 5</label>
                                            <?php
                                                include("config/db.php");
                                                $p = $conn->query("SELECT * FROM plan4 ");
                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <h5><?php if( $plann['id']== $row['p5']){echo $plann['planned'];} ?></h5>
                                            <?php } ?><hr class="new">
                                        </div>  
                                        <div class='form-group'>
                                            <label for="p6" class="col-form-label text-secondary">แผนการเรียนอันดับที่ 6</label>
                                            <?php
                                                include("config/db.php");
                                                $p = $conn->query("SELECT * FROM plan4 ");
                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <h5><?php if( $plann['id']== $row['p6']){echo $plann['planned'];} ?></h5>
                                            <?php } ?><hr class="new">
                                        </div>  
                                        <div class='form-group'>
                                            <label for="p7" class="col-form-label text-secondary">แผนการเรียนอันดับที่ 7</label>
                                            <?php
                                                include("config/db.php");
                                                $p = $conn->query("SELECT * FROM plan4 ");
                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <h5><?php if( $plann['id']== $row['p7']){echo $plann['planned'];} ?></h5>
                                            <?php } ?><hr class="new">
                                        </div>  
                                        <div class='form-group'>
                                            <label for="p8" class="col-form-label text-secondary">แผนการเรียนอันดับที่ 8</label>
                                            <?php
                                                include("config/db.php");
                                                $p = $conn->query("SELECT * FROM plan4 ");
                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <h5><?php if( $plann['id']== $row['p8']){echo $plann['planned'];} ?></h5>
                                            <?php } ?><hr class="new">
                                        </div>  
                                        <div class='form-group'>
                                            <label for="p9" class="col-form-label text-secondary">แผนการเรียนอันดับที่ 9</label>
                                            <?php
                                                include("config/db.php");
                                                $p = $conn->query("SELECT * FROM plan4 ");
                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <h5><?php if( $plann['id']== $row['p9']){echo $plann['planned'];} ?></h5>
                                            <?php } ?><hr class="new">
                                        </div>  
                                        <div class='form-group'>
                                            <label for="p10" class="col-form-label text-secondary">แผนการเรียนอันดับที่ 10</label>
                                            <?php
                                                include("config/db.php");
                                                $p = $conn->query("SELECT * FROM plan4 ");
                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <h5><?php if( $plann['id']== $row['p10']){echo $plann['planned'];} ?></h5>
                                            <?php } ?><hr class="new">
                                        </div>  
                                        <div class='form-group'>
                                            <label for="p11" class="col-form-label text-secondary">แผนการเรียนอันดับที่ 11</label>
                                            <?php
                                                include("config/db.php");
                                                $p = $conn->query("SELECT * FROM plan4 ");
                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <h5><?php if( $plann['id']== $row['p11']){echo $plann['planned'];} ?></h5>
                                            <?php } ?><hr class="new">
                                        </div>  
                                        <div class='form-group'>
                                            <label for="p12" class="col-form-label text-secondary">แผนการเรียนอันดับที่ 12</label>
                                            <?php
                                                include("config/db.php");
                                                $p = $conn->query("SELECT * FROM plan4 ");
                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <h5><?php if( $plann['id']== $row['p12']){echo $plann['planned'];} ?></h5>
                                            <?php } ?><hr class="new">
                                        </div>    
                                    </div>
                                </div>
                            <?php } ?>
                        
                    
                </div>
                    
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