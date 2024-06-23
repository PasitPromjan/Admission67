<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['user_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin.php');
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ระบบรับสมัครนักเรียนเข้าศึกษาต่อระดับชั้นมัธยมศึกษาปีที่ 4</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <style>
    hr.new {
        border: 1px solid;
    }
 </style>

</head>
<body style="background-color: #910000;">
<?php include 'navUser.php'; ?>
    <br>
    <div class="container">
        <?php 

                if (isset($_SESSION['user_login'])) {
                    $user_id = $_SESSION['user_login'];
                    $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
                    $stmt->execute();
                    $row = $stmt->fetch();
                }

                $statuss = $conn->query("SELECT * FROM exist WHERE id = 1 ");
                $data = $statuss->fetch();

                
            ?>
        <div class="bg-light p-5 rounded">
        <?php    if($data['open']==0 && $row['stat']=='0') { ?>
                <center>
                <h4 class='text-danger'>ไม่อยู่ในช่วงเวลาที่เปิดให้สมัคร</h4>
                <a href="index.php" class="btn btn-danger">กลับหน้าหลัก</a>
                </center>
            <?php } else { ?>


                <form action="user_db.php" method="post" enctype="multipart/form-data" >
                    
                    <h3 class="mt-4"> </h3>

                    <div class="row mb-2">
                                    <div class="col-md-4">
                                        <img id="previewImg" src="uploads/<?php echo $row['img']; ?>">
                                        <div class='form-group'>
                                                <label for="sign_id" class="col-form-label text-secondary">เลขที่สมัคร</label>
                                                <h5><?php echo $row['sign_id']; ?></h5>
                                            </div><hr>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="bd-placeholder-img row g-0 border rounded overflow-hidden flex-lg-row mb-4 shadow-sm h-lg-250 position-relative" style="height: 14rem;">
                                            <div class="col p-4 d-flex flex-column position-static">
                                                    <h2 class="mt-4 <?php if($row['stat']<=2){ ?> text-success <?php } else { ?> text-success <?php } ?>"><font color = black>สถานะ : </font>
                                                        <?php if($row['stat']=='0'){ 
                                                            echo '<span class="badge bg-warning">รอการตรวจสอบจากเจ้าหน้าที่</span>';
                                                            } 
                                                            else if ($row['stat']=='1'){
                                                                echo ' <span class="badge bg-danger">ข้อมูลไม่ถูกต้อง ให้แก้ไขข้อมูล</span> <a href="useredit.php" class="btn btn-warning">แก้ไขข้อมูล</a>';
                                                            } 
                                                            else if($row['stat']=='2'){
                                                                echo ' <span class="badge bg-success">เรียบร้อยแล้ว รอประกาศเลขที่นั่งสอบ</span>';
                                                            }
                                                            else if($row['stat']=='3'){
                                                                echo 'ยืนยันแล้ว รอประกาศเลขที่นั่งสอบ';
                                                            }
                                                            else if($row['stat']=='4'){
                                                                echo 'ออกเลขที่นั่งสอบแล้ว';
                                                            }
                                                    ?></h2>
                                                    <?php if($row['comment']!=''){ ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        <h2 class="mt-4"> <?php echo $row['comment'] ?> </h2>
                                                    </div>
                                                    <?php }?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h5 class='text-success'>หลักฐาน</h5>
                                            <div class="col-md-6">
                                                <label for="img_page1" class="col-form-label text-secondary">ปพ 1 ด้านหน้า หรือใบรับรองผลการเรียน</label>
                                                <h5><a href="uploads/<?php echo $row['img_page1']; ?>"><?php echo $row['img_page1']; ?></a></h5><hr class="new">
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <label for="img_page2" class="col-form-label text-secondary">ปพ 1 ด้านหลัง</label>
                                                <h5><a href="uploads/<?php echo $row['img_page2']; ?>"><?php echo $row['img_page2']; ?></a></h5><hr class="new">
                                            </div>
                                        </div>
                                    </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                            <div class="col-md-8">
                                    <div class='row'>
                                        <h5 class='text-success'>ข้อมูลนักเรียน</h5>
                                        <div class='col-md-2'>
                                            <div class='form-group'>
                                                <label for="title" class="col-form-label text-secondary">คำนำหน้า</label>
                                                <h5><?php echo $row['title']; ?></h5>
                                            </div><hr>
                                        </div>
                                        <div class='col-md-5'>
                                            <div class='form-group'>
                                                <label for="firstname" class="col-form-label text-secondary">ชื่อ </label>
                                                <h5><?php echo $row['firstname']; ?></h5>
                                            </div><hr>
                                        </div>
                                        <div class='col-md-5'>
                                            <div class='form-group'>
                                                <label for="lastname" class="col-form-label text-secondary">นามสกุล</label>
                                                <h5><?php echo $row['lastname']; ?></h5>
                                            </div><hr>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class='col-md-7'>
                                            <div class='form-group'>
                                                <label for="StPN" class="col-form-label text-secondary">เบอร์โทรศัพท์</label>
                                                <h5><?php echo $row['StPN']; ?></h5><hr class="new">
                                            </div>
                                            
                                            <div class='form-group'>
                                                <label  for="pid" class="col-form-label text-secondary">เลขบัตรประชาชน</label>
                                                <h5><?php echo $row['pid']; ?></h5><hr class="new">
                                            </div>
                                            
                                            <div class='form-group'>
                                                <label for="date" class="col-form-label text-secondary">วันเกิด</label>
                                                <h5><?php echo $row['date']; ?></h5><hr class="new">
                                            </div>
                                        </div>
                                    </div>    
                                    
                                    
                                    <br>
                                    <div class='row'>
                                        <h5 class='text-success'>ข้อมูลผู้ปกครอง</h5>
                                        <div class='col-md-5'>
                                            <div class='form-group'>
                                                <label for="PaFirstname" class="col-form-label text-secondary">ชื่อ</label>
                                                <h5><?php echo $row['PaFirstname']; ?></h5><hr class="new">
                                            </div>
                                        </div>
                                        <div class='col-md-5'>
                                            <div class='form-group'>
                                                <label for="PaLastname" class="col-form-label text-secondary">นามสกุล</label>
                                                <h5><?php echo $row['PaLastname']; ?></h5><hr class="new">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class='col-md-7'>
                                            
                                            <div class='form-group'>
                                                <label for="PaPN" class="col-form-label text-secondary">เบอร์โทรศัพท์</label>
                                                <h5><?php echo $row['PaPN']; ?></h5><hr class="new">
                                            </div>
                                        </div>
                                    </div>    
                            
                    
                        <br>
                        <div class="row">
                            <div class='col-md-7'>
                                <h5 class='text-success'>ข้อมูลโรงเรียน</h5>
                                <div class='form-group'>
                                    <label for="oldschool" class="col-form-label text-secondary">ชื่อโรงเรียน</label>
                                    <h5><?php echo $row['oldschool']; ?></h5><hr class="new">
                                </div>
                                <div class='form-group'>
                                    <label for="OS_Province" class="col-form-label text-secondary">เบอร์โทรศัพท์</label>
                                    <h5><?php echo $row['OS_Province']; ?></h5><hr class="new">
                                </div>
                            </div>
                        </div>
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
                        </div>
                    </div>
                </div>
                    
                
                        <?php if(isset($_SESSION['status'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <?php 
                                    echo $_SESSION['status'];
                                    unset($_SESSION['status']);
                                ?>
                            </div>
                        <?php } ?>
                        

                </form>
            <?php   } ?>
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
</body>
</html>