<?php 

    session_start();
    require_once 'config/db.php';

?>
<?php
    include('config/connect.php');
    $sql = "SELECT * FROM provinces order by name_th";
    $query = mysqli_query($connn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="icon.png">
    <title>ระบบรับสมัครนักเรียนเข้าศึกษาต่อระดับชั้นมัธยมศึกษาปีที่ 1และ 4</title>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="background-color: #910000;">
<?php  include 'nav.php'; ?>
   
    <div class="container">
        <br>
        <form action="signup_db.php" method="POST"  enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="bg-light p-5 rounded">
                
                <h4 class='text-center text-dark alert alert-warning'>สมัครเรียนชั้นมัธยมศึกษาปีที่ 4 ประเภทห้องเรียนปกติ</h4>
                <hr>
                <?php if(isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php 
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        ?>
                    </div>
                <?php } ?>
                <?php if(isset($_SESSION['success'])) { ?>
                        <?php
                        
                            unset($_SESSION['success']);
                        ?>
                <?php } ?>
                <?php if(isset($_SESSION['warning'])) { ?>
                    <div class="alert alert-warning" role="alert">
                        <?php 
                            echo $_SESSION['warning'];
                            unset($_SESSION['warning']);
                        ?>
                    </div>
                <?php } ?>

                <div class="mb-3">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <img src="images/profile.png" id="previewImg">
                            <input class="form-control" type="file" id="imgInput" name="img" accept="image/png, image/jpeg, image/jpg" required>
                        </div>
                        <div class="col-md-6"><br><br><br>
                        <h4>หลักฐานที่ต้องใช้ในการสมัคร</h4>
                            <div align="left">
                            1.รูปถ่ายนักเรียนหน้าตรงแนวตั้ง (สามารถใช้โทรศัพท์มือถือถ่ายได้) <br>
                            2.เอกสารแสดงว่ากำลังศึกษาหรือจบการศึกษา ปพ.1  "ด้านหน้า"  หรือ ใบรับรองผลการเรียน ปพ.7 ที่แสดงผลการเรียน ม.1-3 <br>
                            3.เอกสารแสดงว่ากำลังศึกษาหรือจบการศึกษา ปพ.1  "ด้านหลัง"  หรือ ใบรับรองผลการเรียน ปพ.7 ใบเดิม <br>
                            4.สำเนาทะเบียนบ้าน<br>
                            <f class="text-danger">***กรณีเอกสารข้อ 2 เป็นใบรับรองผลการเรียน ให้ใช้ใบรับรองผลในข้อ 3***</f><br>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label"><h4>ตัวอย่าง</h4></label><br>
                            <img height="192px " src="1.jpg">
                        </div>
                    </div>
                    <br>
                    <hr>

                    <div class="row g-3">
                        <div class="col-md-12"><h5 class='text-primary'>ข้อมูลนักเรียน</h5></div>
                        <div class="col-md-2">
                            <label for="validationCustom01" class="col-form-label" >คำนำหน้า</label>
                            <select  name="title" class="form-control" id="validationCustom01" required>
                                <option value=""></option>
                                <option value="นาย">นาย</option>
                                <option value="นางสาว" >นางสาว</option>
                                <option value="เด็กชาย" >เด็กชาย</option>
                                <option value="เด็กหญิง" >เด็กหญิง</option>
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                                    
                        </div>
                        <div class="col-md-5">
        
                            <label for="validationCustom02" class="col-form-label">ชื่อ</label>
                            <input type="text" name="firstname" required class="form-control" id="validationCustom02" name="firstname" minlength="3">
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                                    
                        </div>
                        <div class="col-md-5">
        
                            <label for="validationCustom03" class="col-form-label">นามสกุล</label>
                            <input type="text" name="lastname" required class="form-control" id="validationCustom03" name="lastname" minlength="3">
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                                    
                        </div>
                        <div class="col-md-4">

                            <label>เลขบัตรประชาชน (เลข 13 หลัก)</label>
                            <input type='text' name='pid' required  minlength="13" maxlength="13" pattern="[0-9]*" class='form-control' id="validationCustom04" >
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล เลข 13 หลัก
                            </div>
                                
                        </div>
                        <div class="col-md-4">
                            <label>วันเกิด (วว/ดด/ปปปป เช่น 22/03/2550)</label>     
                            <input type="text" class="form-control" name="date" pattern="\d{2}/\d{2}/\d{4}" title="วว/ดด/ปปปป" required>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล และกรอกรูปแบบให้ถูกต้อง 
                            </div>

                        </div>  
                        <div class='col-md-4'>
                            <label>เบอร์โทรศัพท์ (ตัวเลข 10 หลัก เช่น 0822483771)</label>
                            <input type='text' name='StPN' required class='form-control' id="validationCustom06" minlength="10" maxlength="10" pattern="[0-9]*">
                            <div class="invalid-feedback">
                                กรุณากรอกเบอร์ 10 หลัก
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>

                    <div class="row g-3">   
                        <div class="col-md-12"><h5 class='text-primary'>ข้อมูลผู้ปกครอง</h5></div>
                        <div class='col-md-4'>
                            <label for="PaFirstname" class="col-form-label">ชื่อ</label>
                            <input type="text" name="PaFirstname" required class="form-control" name="PaFirstname" >
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                        <div class='col-md-4'>
                            <label for="PaLastname" class="col-form-label">นามสกุล</label>
                            <input type="text" name="PaLastname" required class="form-control" name="PaLastname">
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                        
                        
                        <div class='col-md-4'>
                            <div class='form-group'>
                            <label for="PaPN" class="col-form-label">เบอร์โทรศัพท์</label>
                            <input type='text' name='PaPN' required class='form-control'>
                            <div class="invalid-feedback">
                                กรุณากรอกเบอร์ 10 หลัก
                            </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>

                    <div class="row g-3">       
                        <h5 class='text-primary'>ข้อมูลโรงเรียน</h5>
                        <div class="col-md-6">
                                
                            <label for="oldschool" class="col-form-label">ชื่อโรงเรียน <font color="red">(ไม่ต้องมีคำว่าโรงเรียน เช่น "กำแพงเพชรพิทยาคม")</font></label>
                            <input type="text" name="oldschool" required class="form-control" name="oldschool" >
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                                
                        </div>
                            
                        <div class="col-md-6">
                            <label for="OS_Province" class="col-form-label">จังหวัด</label>
                            <select name="OS_Province" class="form-control" required>
                                <option value="">เลือกจังหวัด</option>
                            <?php
                                $spro = $conn->query("SELECT * FROM provinces order by name_th");
                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                ?>              
                                    <option value="<?=$c['id']?>"><?=$c['name_th']?></option>                     
                            <?php } ?>
                                                            
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                    </div>
                
                    <br>
                    <hr>
                    <div class="row g-3">    
                        <h5 class='text-primary'>ที่อยู่ตามทะเบียนบ้าน</h5>
                        <div class='form-group'>
                            <label for="address">ที่อยู่ (บ้านเลขที่ , ถนน , ซอย ,...)</label>
                            <textarea class="form-control " name="address" id="address" required></textarea>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                            
                        <div class="col-md-4">
                            <label for="province">จังหวัด</label>
                            <select name="AD_Province" id="province" class="form-control" required>
                                <option value="">เลือกจังหวัด</option>
                                <?php while($result = mysqli_fetch_assoc($query)): ?>
                                    <option value="<?=$result['id']?>"><?=$result['name_th']?></option>
                                <?php endwhile; ?>
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="amphure">อำเภอ</label>
                            <select name="AD_Subdistrict" id="amphure" class="form-control" required>
                                <option value="">เลือกอำเภอ</option>
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="district">ตำบล</label>
                            <select name="AD_District" id="district" class="form-control" required>
                                <option value="">เลือกตำบล</option>
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>

                    <div class="row g-3">    
                        <h5 class='text-primary'>หลักฐานประกอบการสมัคร (ไฟล์ประเภท png , jpeg , jpg ขนาดไฟล์ไม่เกิน: 4 MB :<a href="https://picresize.com/" target="_blank" > ย่อขนาดรูป</a>  )</h5>
                        <div class="col-md-8">
                            <label for="img2" class="form-label">ปพ 1 ด้านหน้า หรือใบรับรองผลการเรียน</label>
                            <input class="form-control"  accept="image/* , application/pdf" type="file" id="img2" name="img_page1" required>
                        </div>
                        
                        <div class="col-md-4">
                            <label  class="form-label">ตัวอย่าง</label><br>
                            <img height="150px "  src="2.jpg">
                            หรือ
                            <img height="150px "  src="4.JPG">
                        </div>
                        
                        <div class="col-md-8">
                            <label for="img3" class="form-label">ปพ 1 ด้านหลัง (ถ้าไม่มีให้ใช้ไฟล์เดียวกับ ปพ1 ด้านหน้า)</label>
                            <input class="form-control" accept="image/* , application/pdf" type="file" id="img3" name="img_page2" required>
                        </div>
                        <div class="col-md-4">
                        
                            <label  class="form-label">ตัวอย่าง</label><br>
                            <img height="150px "  src="3.jpg">
                            หรือ
                            <img height="150px "  src="4.JPG">
                        
                        </div>

                        <div class="col-md-8">
                            <label for="img4" class="form-label">สำเนาทะเบียนบ้าน</label>
                            <input class="form-control" accept="image/* , application/pdf" type="file" id="img3" name="img_page3" required>
                        </div>
                        <div class="col-md-4">
                        
                            <label  class="form-label">ตัวอย่าง</label><br>
                            <img height="150px "  src="5.png">
                        
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <h5 class='text-primary'>แผนการเรียน</h5>
                        <div class='form-group'>
                            <label for="p1" class="col-form-label">แผนการเรียนอันดับที่ 1</label>
                            <select name="p1" class="form-control" required>
                            <option value="">---เลือกแผนการเรียน---</option>
                            <?php
                                $spro = $conn->query("SELECT * FROM plan4 ");
                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                    if($c['id']!=13){
                            ?>              
                            <option value="<?=$c['id']?>"><?=$c['planned']?></option>                     
                            <?php } } ?>
                                                        
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for="p2" class="col-form-label">แผนการเรียนอันดับที่ 2</label>
                            <select name="p2" class="form-control" required>
                            <option value="">---เลือกแผนการเรียน---</option>
                            <?php
                                $spro = $conn->query("SELECT * FROM plan4 ");
                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                            ?>              
                            <option value="<?=$c['id']?>"><?=$c['planned']?></option>                     
                            <?php } ?>
                                                        
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for="p3" class="col-form-label">แผนการเรียนอันดับที่ 3</label>
                            <select name="p3" class="form-control" required>
                            <option value="">---เลือกแผนการเรียน---</option>
                            <?php
                                $spro = $conn->query("SELECT * FROM plan4 ");
                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                            ?>              
                            <option value="<?=$c['id']?>"><?=$c['planned']?></option>   
                                             
                            <?php } ?>
                                                        
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for="p4" class="col-form-label">แผนการเรียนอันดับที่ 4</label>
                            <select name="p4" class="form-control" required>
                            <option value="">---เลือกแผนการเรียน---</option>
                            <?php
                                $spro = $conn->query("SELECT * FROM plan4 ");
                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                            ?>              
                            <option value="<?=$c['id']?>"><?=$c['planned']?></option>   
                                             
                            <?php } ?>
                                                        
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for="p5" class="col-form-label">แผนการเรียนอันดับที่ 5</label>
                            <select name="p5" class="form-control" required>
                            <option value="">---เลือกแผนการเรียน---</option>
                            <?php
                                $spro = $conn->query("SELECT * FROM plan4 ");
                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                            ?>              
                            <option value="<?=$c['id']?>"><?=$c['planned']?></option>   
                                             
                            <?php } ?>
                                                        
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for="p6" class="col-form-label">แผนการเรียนอันดับที่ 6</label>
                            <select name="p6" class="form-control" required>
                            <option value="">---เลือกแผนการเรียน---</option>
                            <?php
                                $spro = $conn->query("SELECT * FROM plan4 ");
                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                            ?>              
                            <option value="<?=$c['id']?>"><?=$c['planned']?></option>   
                                             
                            <?php } ?>
                                                        
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for="p7" class="col-form-label">แผนการเรียนอันดับที่ 7</label>
                            <select name="p7" class="form-control" required>
                            <option value="">---เลือกแผนการเรียน---</option>
                            <?php
                                $spro = $conn->query("SELECT * FROM plan4 ");
                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                            ?>              
                            <option value="<?=$c['id']?>"><?=$c['planned']?></option>   
                                             
                            <?php } ?>
                                                        
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for="p8" class="col-form-label">แผนการเรียนอันดับที่ 8</label>
                            <select name="p8" class="form-control" required>
                            <option value="">---เลือกแผนการเรียน---</option>
                            <?php
                                $spro = $conn->query("SELECT * FROM plan4 ");
                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                            ?>              
                            <option value="<?=$c['id']?>"><?=$c['planned']?></option>   
                                             
                            <?php } ?>
                                                        
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for="p9" class="col-form-label">แผนการเรียนอันดับที่ 9</label>
                            <select name="p9" class="form-control" required>
                            <option value="">---เลือกแผนการเรียน---</option>
                            <?php
                                $spro = $conn->query("SELECT * FROM plan4 ");
                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                            ?>              
                            <option value="<?=$c['id']?>"><?=$c['planned']?></option>   
                                             
                            <?php } ?>
                                                        
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for="p10" class="col-form-label">แผนการเรียนอันดับที่ 10</label>
                            <select name="p10" class="form-control" required>
                            <option value="">---เลือกแผนการเรียน---</option>
                            <?php
                                $spro = $conn->query("SELECT * FROM plan4 ");
                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                            ?>              
                            <option value="<?=$c['id']?>"><?=$c['planned']?></option>   
                                             
                            <?php } ?>
                                                        
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for="p11" class="col-form-label">แผนการเรียนอันดับที่ 11</label>
                            <select name="p11" class="form-control" required>
                            <option value="">---เลือกแผนการเรียน---</option>
                            <?php
                                $spro = $conn->query("SELECT * FROM plan4 ");
                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                            ?>              
                            <option value="<?=$c['id']?>"><?=$c['planned']?></option>   
                                             
                            <?php } ?>
                                                        
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for="p12" class="col-form-label">แผนการเรียนอันดับที่ 12</label>
                            <select name="p12" class="form-control" required>
                            <option value="">---เลือกแผนการเรียน---</option>
                            <?php
                                $spro = $conn->query("SELECT * FROM plan4 ");
                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                            ?>              
                            <option value="<?=$c['id']?>"><?=$c['planned']?></option>   
                                             
                            <?php } ?>
                                                        
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล
                            </div>
                        </div>
                        

                    </div>

            </div>
                    
            <br>
            <hr>
            <button type="submit" name="signup" class="btn btn-primary">ยืนยันการสมัคร</button>
        </form>
        
    </div>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
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

        <link href="datepicker/css/datepicker.css" rel="stylesheet" media="screen">



    <script src="assets/jquery.min.js"></script>
    <script src="assets/script.js"></script>
    <script src="assets/tes.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
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