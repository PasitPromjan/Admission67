<?php 
    session_start();
    require_once 'config/db.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="icon.png">
    <title>ระบบรับสมัครนักเรียนเข้าศึกษาต่อระดับชั้นมัธยมศึกษาปีที่ 1และ 4</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">



</head>
<body style="background-color: #910000;">
<?php include 'nav.php';?>
    <br>
    
        <div class="container">
            <div class="bg-light p-5 rounded">
                <h3 class="mt-4">ตรวจสอบการสมัคร ชั้นมัธยมศึกษาปีที่ 1 และ 4 ประเภทห้องเรียนปกติ</h3>
                <hr>
                <form action="signin_db.php" method="post" class="needs-validation" novalidate>
                    <?php if(isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php 
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            ?>
                        </div>
                    <?php } ?>
                    <?php if(isset($_SESSION['success'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?php 
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                            ?>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="pid" class="form-label">เลขบัตรประชาชน 13 หลัก</label>
                            <input type="pid" class="form-control" name="pid" minlength="13" maxlength="13" pattern="[0-9]*" required>
                            <div class="invalid-feedback">
                                    กรุณากรอกข้อมูล และกรอกรูปแบบให้ถูกต้อง
                                </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="date" class="form-label">วันเกิด (วว/ดด/ปปปป เช่น 22/03/2550)</label>     
                            <input type="text" class="form-control" name="date" pattern="\d{2}/\d{2}/\d{4}" required>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล และกรอกรูปแบบให้ถูกต้อง 
                            </div>
                        </div>        
                        <div class="col-md-2">
                            <label for="class" class="form-label">ชั้น </label>
                            <select  name="class" class="form-control" required>
                                <option value=""></option>
                                <option value="1">ม.1</option>
                                <option value="4">ม.4</option>
                            </select>
                            <div class="invalid-feedback">
                                    กรุณากรอกข้อมูล 
                                </div>
                        </div>
                        <div class="col-md-3">
                            <br>
                        <button type="submit" name="signin" class="btn btn-outline-primary">ตรวจสอบ</button>
                        </div>           
                    </div>
                    
                </form>
            </div>
        </div>
        <br>
        
                  
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
                        $row = $stmt->fetch();
                } 
                $stmtt = $conn->query("SELECT * FROM exist WHERE id=1");
                $stmtt->execute();
                $data = $stmtt->fetch(PDO::FETCH_ASSOC);
                ?>
        
        <?php if (isset($_GET['id'])&&isset($_GET['class'])) {  ?>
        <div class="container">  
            <div class="bg-light p-5 rounded">   
                <br>
                    <h5 class='text-success'>ข้อมูล การสมัคร ระดับชั้น ม. <?php echo $class; ?> ประเภทห้องเรียนปกติ </h5> 
                    <br>
                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <img id="previewImg" src="uploads/<?php echo $row['img']; ?>">
                                            <div class='form-group'>
                                                    <label for="sign_id" class="col-form-label text-secondary">เลขที่สมัคร</label>
                                                    <h5><?php echo $row['sign_id']; ?></h5>
                                                </div><hr>
                                                <?php
                                                    $query = array(
                                                        'id' => $id, 
                                                        'class' => $class
                                                        );
                                                    
                                                    $query = http_build_query($query); 
                                                    ?>
                                                    <?php if($data['edits']==1 && $row['stat']!='2' && $row['stat']!='3') { ?>
                                                    <a href="signinEdit?<?php echo $query; ?>" class="btn btn-outline-warning me-2">แก้ไขข้อมูล</a>
                                                    <?php } ?>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="bd-placeholder-img row g-0 border rounded overflow-hidden flex-lg-row mb-4 shadow-sm h-lg-250 position-relative" >
                                                <div class="col p-4 d-flex flex-column position-static">
                                                        <h2 class="mt-4 <?php if($row['stat']<=2){ ?> text-success <?php } else { ?> text-success <?php } ?>"><font color = black>สถานะ : </font>
                                                            <?php if($row['stat']=='0'){ 
                                                                echo '<span class="badge bg-warning">รอการตรวจสอบ</span>';
                                                                } 
                                                                else if ($row['stat']=='1'){
                                                                    echo ' <span class="badge bg-danger">ไม่ผ่านการตรวจสอบ</span> แก้ไขตามที่แจ้ง';
                                                                } 
                                                                else if($row['stat']=='2'){
                                                                    echo ' <span class="badge bg-success">ผ่านการตรวจสอบ </span> รอประกาศเลขที่นั่งสอบ' ;
                                                                }
                                                                else if($row['stat']=='3'){
                                                                    echo '  <span class="badge bg-success">ประกาศเลขที่นั่งสอบแล้ว </span>';
                                                                }
                                                                else if($row['stat']=='4'){
                                                                    echo 'ออกเลขที่นั่งสอบแล้ว';
                                                                }
                                                        ?></h2>
                                                        
                                                </div>
                                            </div>
                                            <?php if($row['comment']!=''){ ?>
                                                        <div class="alert alert-danger" role="alert">
                                                            <h2 class="mt-4"> <?php echo $row['comment'] ?> </h2>
                                                        </div>
                                                        <?php }?>
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
                                            <label for="oldschool" class="col-form-label text-secondary">ชื่อโรงเรียน (ไม่ต้องมีคำว่าโรงเรียน เช่น "กำแพงเพชรพิทยาคม")</label>
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

                <?php } ?>

            </div>
        </div>
    
    
    <script src="signin_ajax.js"></script>
    <script src="assets/jquery.min.js"></script>
    <script src="assets/script.js"></script>
    <script src="assets/tes.js"></script>
    <script src="assets/url.js"></script>
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
    
    <script>
        (() => {
            'use strict'


            const forms = document.querySelectorAll('.needs-validation')

            
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>
</html>