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
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="background-color: #910000;">
<?php include 'nav.php';?>
    <br>
    <div class="container">
        <div class="bg-light p-5 rounded">
            <form action="signinEdit_db.php" method="post" class="needs-validation" novalidate>
                <?php if (!isset($_GET['id'])&&!isset($_GET['class'])) { ?>
                    <h3 class="mt-4">แก้ไขข้อมูลการสมัคร ชั้นมัธยมศึกษาปีที่ 1 และ 4 ประเภทห้องเรียนปกติ</h3>
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
               
                <div class="row">
                    <div class="col-md-4">
                        <label for="pidLogin" class="form-label">เลขบัตรประชาชน 13 หลัก</label>
                        <input type="pidLogin" class="form-control" name="pidLogin" minlength="13" maxlength="13" pattern="[0-9]*" required>
                        <div class="invalid-feedback">
                                กรุณากรอกข้อมูล และกรอกรูปแบบให้ถูกต้อง
                            </div>
                    </div>
                    <div class="col-md-3">
                        <label for="date" class="form-label">วันเกิด (วว/ดด/ปปปป เช่น 22/03/2550)</label>     
                        <input type="text" class="form-control" name="dateLogin" pattern="\d{2}/\d{2}/\d{4}" required>
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
                    <button type="submit" name="signinEdit" class="btn btn-outline-primary">แก้ไข</button>
                    </div>           
                </div>
            <?php } ?>   
            </form>

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
                <h1>แก้ไขข้อมูล ชั้นมัธยมศึกษาปีที่ <?php echo $class; ?> ประเภทห้องเรียนปกติ</h1>
            <hr>
            <form action="useredit_db.php" method="post" enctype="multipart/form-data">
                   <div class='row'>
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <img src="uploads/<?php echo $row['img']; ?>" id="previewImg">
                                    <input class="form-control" type="file" id="imgInput" name="img">
                                    <input type="hidden" value="<?php echo $row['img']; ?>"  class="form-control" name="img2" >
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
                                        <input type="text" value="<?php echo $row['firstname']; ?>" name="firstname"  class="form-control" name="firstname" >
                                        <input type="hidden" value="<?php echo $row['id']; ?>" name="id"  class="form-control" >
                                    </div>
                                </div>
                                <div class='col-md-5'>
                                    <div class='form-group'>
                                        <label for="lastname" class="col-form-label">นามสกุล</label>
                                        <input type="text" value="<?php echo $row['lastname']; ?>" name="lastname"  class="form-control" name="lastname">
                                    </div>
                                </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="pid" class="form-label">เลขบัตรประชาชน</label>
                                <input type='text' readonly name='pid' value="<?php echo $row['pid']; ?>" minlength="13" maxlength="13" pattern="[0-9]*"  class='form-control'>
                            </div>
                            <div class="col-md-3">
                                <label for="datepicker2" class="form-label">วันเกิด</label>
                                <input type='text' <?php if($row['stat']!='0' && $row['stat']!='1'){ ?>readonly <?php } ?> name='date' value="<?php echo $row['date']; ?>" pattern="\d{2}/\d{2}/\d{4}"  class='form-control'>
                            </div>
                            <div class="col-md-5">
                            <label for="StPN" class="form-label">เบอร์โทรศัพท์</label>
                                <input type='text' name='StPN' value="<?php echo $row['StPN']; ?>" minlength="10" maxlength="10"  class='form-control'>
                            </div>
                        <div>
                    
                    
                    <br>
                    <hr>

                    <div class='row'>
                        <h5 class='text-success'>ข้อมูลผู้ปกครอง</h5>
                            <div class='col-md-4'>
                                <div class='form-group'>
                                    <label for="PaFirstname" class="col-form-label">ชื่อ</label>
                                    <input type="text" value="<?php echo $row['PaFirstname']; ?>" name="PaFirstname"  class="form-control" name="PaFirstname" >
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <div class='form-group'>
                                    <label for="PaLastname" class="col-form-label">นามสกุล</label>
                                    <input type="text" value="<?php echo $row['PaLastname']; ?>" name="PaLastname"  class="form-control" name="PaLastname">
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <div class='form-group'>
                                <label for="PaPN" class="col-form-label">เบอร์โทรศัพท์</label>
                                <input type='text' value="<?php echo $row['PaPN']; ?>" name='PaPN'  class='form-control'>
                                </div>
                            </div>
                    </div>
                    <br>
                    <br>
                    <hr>

                    <div class="row">
                        <h5 class='text-success'>ข้อมูลโรงเรียน</h5>
                            <div class="col-md-6">
                                <div class='form-group'>
                                    <label for="oldschool" class="col-form-label">ชื่อโรงเรียน</label>
                                    <input type="text" value="<?php echo $row['oldschool']; ?>" name="oldschool"  class="form-control" name="oldschool" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class='form-group'>
                                    <label for="OS_Province" class="col-form-label">จังหวัด</label>
                                    <select name="OS_Province" class="form-control" >
                                        <!--<option value="<?php echo $data['p1'] ?> " SELECTED ><?php echo $data['p1'] ?></option>-->
                                    <?php
                                            $OS = $row['OS_Province'];
                                            $prov = $conn->query("SELECT * FROM provinces WHERE id = $OS order by name_th");
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
                                <div class="row">
                                    <div class="col-md-4">
                                    <label for="province">จังหวัด</label>
                                        <?php
                                            $AD = $row['AD_Province'];
                                            $prov = $conn->query("SELECT * FROM provinces WHERE id = $AD order by name_th");
                                            $prov ->execute();
                                            $re = $prov->fetch(PDO::FETCH_ASSOC)
                                        ?>
                                    <select name="AD_Province" id="province" class="form-control">
                                    
                                            <option value="<?=$row['AD_Province']?>"><?=$re['name_th']?></option>
                                        <?php while($result = mysqli_fetch_assoc($query)): ?>
                                            <option value="<?=$result['id']?>"><?=$result['name_th']?></option>
                                        <?php endwhile; ?>
                                    </select>
                                    </div>
                                    <div class="col-md-4">
                                    <label for="amphure">อำเภอ</label>
                                        <?php
                                            $AD = $row['AD_Subdistrict'];
                                            $prov = $conn->query("SELECT * FROM amphures WHERE id = $AD order by name_th");
                                            $prov ->execute();
                                            $re = $prov->fetch(PDO::FETCH_ASSOC)
                                        ?>
                                    <select name="AD_Subdistrict" id="amphure" class="form-control">
                                        <option value="<?=$row['AD_Subdistrict']?>"><?=$re['name_th']?></option>
                                        <option value="">เลือกอำเภอ</option>
                                    </select>
                                    </div>
                                    <div class="col-md-4">
                                    <label for="district">ตำบล</label>
                                        <?php
                                            $AD = $row['AD_District'];
                                            $prov = $conn->query("SELECT * FROM districts WHERE id = $AD order by name_th");
                                            $prov ->execute();
                                            $re = $prov->fetch(PDO::FETCH_ASSOC)
                                        ?>
                                    <select name="AD_District" id="district" class="form-control">
                                        <option value="<?=$row['AD_District']?>"><?=$re['name_th']?></option>
                                        <option value="">เลือกตำบล</option>
                                    </select>
                                    </div>
                                </div>

                    </div>
                    <br>
                    <hr>
                    <?php if($class== "4") {?>
                        <input type="hidden" value="4" name="classed"  class="form-control" >
                                <br>
                                <div class="row">
                                    <h5 class='text-success'>แผนการเรียน</h5>
                                    <div class="col-md-7">
                                        <div class='form-group'>
                                            <input type='hidden' value="<?php echo $row['p1']; ?>" name='p1_old'  class='form-control'>
                                            <label for="p1" class="col-form-label">แผนการเรียนอันดับที่ 1</label>
                                            <select name="p1" class="form-control" >
                                                <!--<option value="<?php echo $data['p1'] ?> " SELECTED ><?php echo $data['p1'] ?></option>-->
                                            <?php
                                                    $OS = $row['p1'];
                                                    $p = $conn->query("SELECT * FROM plan4 WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan4 ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                            <?php if($c['id']!=4){ ?>              
                                            <option value="<?=$c['id']?>" <?php if($row['p1']==$c['id']){ ?> selected <?php } ?> ><?=$c['planned']?></option>                     
                                            <?php } } ?>
                                                                
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <input type='hidden' value="<?php echo $row['p2']; ?>" name='p2_old'  class='form-control'>
                                            <label for="p2" class="col-form-label">แผนการเรียนอันดับที่ 2</label>
                                            <select name="p2" class="form-control" >
                                                <!--<option value="<?php echo $data['p2'] ?> " SELECTED ><?php echo $data['p2'] ?></option>-->
                                            <?php
                                                    $OS = $row['p2'];
                                                    $p = $conn->query("SELECT * FROM plan4 WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan4 ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>              
                                            <option value="<?=$c['id']?>" <?php if($row['p2']==$c['id']){ ?> selected <?php } ?>><?=$c['planned']?></option>                     
                                            <?php } ?>
                                                                
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <input type='hidden' value="<?php echo $row['p3']; ?>" name='p3_old'  class='form-control'>
                                            <label for="p3" class="col-form-label">แผนการเรียนอันดับที่ 3</label>
                                            <select name="p3" class="form-control" >
                                                <!--<option value="<?php echo $data['p3'] ?> " SELECTED ><?php echo $data['p3'] ?></option>-->
                                            <?php
                                                    $OS = $row['p3'];
                                                    $p = $conn->query("SELECT * FROM plan4 WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan4 ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>              
                                            <option value="<?=$c['id']?>" <?php if($row['p3']==$c['id']){ ?> selected <?php } ?>><?=$c['planned']?></option>                     
                                            <?php } ?>
                                                                
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <input type='hidden' value="<?php echo $row['p4']; ?>" name='p4_old'  class='form-control'>
                                            <label for="p4" class="col-form-label">แผนการเรียนอันดับที่ 4</label>
                                            <select name="p4" class="form-control" >
                                                <!--<option value="<?php echo $data['p4'] ?> " SELECTED ><?php echo $data['p4'] ?></option>-->
                                            <?php
                                                    $OS = $row['p4'];
                                                    $p = $conn->query("SELECT * FROM plan4 WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan4 ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>              
                                            <option value="<?=$c['id']?>" <?php if($row['p4']==$c['id']){ ?> selected <?php } ?>><?=$c['planned']?></option>                     
                                            <?php } ?>
                                                                
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <input type='hidden' value="<?php echo $row['p5']; ?>" name='p5_old'  class='form-control'>
                                            <label for="p5" class="col-form-label">แผนการเรียนอันดับที่ 5</label>
                                            <select name="p5" class="form-control" >
                                                <!--<option value="<?php echo $data['p5'] ?> " SELECTED ><?php echo $data['p5'] ?></option>-->
                                            <?php
                                                    $OS = $row['p5'];
                                                    $p = $conn->query("SELECT * FROM plan4 WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan4 ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>              
                                            <option value="<?=$c['id']?>" <?php if($row['p5']==$c['id']){ ?> selected <?php } ?>><?=$c['planned']?></option>                     
                                            <?php } ?>
                                                                
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <input type='hidden' value="<?php echo $row['p6']; ?>" name='p6_old'  class='form-control'>
                                            <label for="p6" class="col-form-label">แผนการเรียนอันดับที่ 6</label>
                                            <select name="p6" class="form-control" >
                                                <!--<option value="<?php echo $data['p6'] ?> " SELECTED ><?php echo $data['p6'] ?></option>-->
                                            <?php
                                                    $OS = $row['p6'];
                                                    $p = $conn->query("SELECT * FROM plan4 WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan4 ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>              
                                            <option value="<?=$c['id']?>" <?php if($row['p6']==$c['id']){ ?> selected <?php } ?>><?=$c['planned']?></option>                     
                                            <?php } ?>
                                                                
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <input type='hidden' value="<?php echo $row['p7']; ?>" name='p7_old'  class='form-control'>
                                            <label for="p7" class="col-form-label">แผนการเรียนอันดับที่ 7</label>
                                            <select name="p7" class="form-control" >
                                                <!--<option value="<?php echo $data['p7'] ?> " SELECTED ><?php echo $data['p7'] ?></option>-->
                                            <?php
                                                    $OS = $row['p7'];
                                                    $p = $conn->query("SELECT * FROM plan4 WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan4 ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>              
                                            <option value="<?=$c['id']?>" <?php if($row['p7']==$c['id']){ ?> selected <?php } ?>><?=$c['planned']?></option>                     
                                            <?php } ?>
                                                                
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <input type='hidden' value="<?php echo $row['p8']; ?>" name='p8_old'  class='form-control'>
                                            <label for="p8" class="col-form-label">แผนการเรียนอันดับที่ 8</label>
                                            <select name="p8" class="form-control" >
                                                <!--<option value="<?php echo $data['p8'] ?> " SELECTED ><?php echo $data['p8'] ?></option>-->
                                            <?php
                                                    $OS = $row['p8'];
                                                    $p = $conn->query("SELECT * FROM plan4 WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan4 ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>              
                                            <option value="<?=$c['id']?>" <?php if($row['p8']==$c['id']){ ?> selected <?php } ?>><?=$c['planned']?></option>                     
                                            <?php } ?>
                                                                
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <input type='hidden' value="<?php echo $row['p9']; ?>" name='p9_old'  class='form-control'>
                                            <label for="p9" class="col-form-label">แผนการเรียนอันดับที่ 9</label>
                                            <select name="p9" class="form-control" >
                                                <!--<option value="<?php echo $data['p9'] ?> " SELECTED ><?php echo $data['p9'] ?></option>-->
                                            <?php
                                                    $OS = $row['p9'];
                                                    $p = $conn->query("SELECT * FROM plan4 WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan4 ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>              
                                            <option value="<?=$c['id']?>" <?php if($row['p9']==$c['id']){ ?> selected <?php } ?>><?=$c['planned']?></option>                     
                                            <?php } ?>
                                                                
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <input type='hidden' value="<?php echo $row['p10']; ?>" name='p10_old'  class='form-control'>
                                            <label for="p10" class="col-form-label">แผนการเรียนอันดับที่ 10</label>
                                            <select name="p10" class="form-control" >
                                                <!--<option value="<?php echo $data['p10'] ?> " SELECTED ><?php echo $data['p10'] ?></option>-->
                                            <?php
                                                    $OS = $row['p10'];
                                                    $p = $conn->query("SELECT * FROM plan4 WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan4 ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>              
                                            <option value="<?=$c['id']?>" <?php if($row['p10']==$c['id']){ ?> selected <?php } ?>><?=$c['planned']?></option>                     
                                            <?php } ?>
                                                                
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <input type='hidden' value="<?php echo $row['p11']; ?>" name='p11_old'  class='form-control'>
                                            <label for="p11" class="col-form-label">แผนการเรียนอันดับที่ 11</label>
                                            <select name="p11" class="form-control" >
                                                <!--<option value="<?php echo $data['p11'] ?> " SELECTED ><?php echo $data['p11'] ?></option>-->
                                            <?php
                                                    $OS = $row['p11'];
                                                    $p = $conn->query("SELECT * FROM plan4 WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan4 ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>              
                                            <option value="<?=$c['id']?>" <?php if($row['p11']==$c['id']){ ?> selected <?php } ?>><?=$c['planned']?></option>                     
                                            <?php } ?>
                                                                
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <input type='hidden' value="<?php echo $row['p12']; ?>" name='p12_old'  class='form-control'>
                                            <label for="p12" class="col-form-label">แผนการเรียนอันดับที่ 12</label>
                                            <select name="p12" class="form-control" >
                                                <!--<option value="<?php echo $data['p12'] ?> " SELECTED ><?php echo $data['p12'] ?></option>-->
                                            <?php
                                                    $OS = $row['p12'];
                                                    $p = $conn->query("SELECT * FROM plan4 WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan4 ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>              
                                            <option value="<?=$c['id']?>" <?php if($row['p12']==$c['id']){ ?> selected <?php } ?>><?=$c['planned']?></option>                     
                                            <?php } ?>
                                                                
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <br>
                                <hr>
                        <?php }?>
                    <?php if($class == "1"){ ?>
                        <input type="hidden" value="1" name="classed"  class="form-control" >
                                <br>
                                <div class="row">
                                    <h5 class='text-success'>แผนการเรียน</h5>
                                    <div class="col-md-7">
                                        <div class='form-group'>
                                            <input type='hidden' value="<?php echo $row['p1']; ?>" name='p1_old'  class='form-control'>
                                            <label for="p1" class="col-form-label">แผนการเรียนอันดับที่ 1</label>
                                            <select name="p1" class="form-control" >
                                                <!--<option value="<?php echo $data['p1'] ?> " SELECTED ><?php echo $data['p1'] ?></option>-->
                                            <?php
                                                    $OS = $row['p1'];
                                                    $p = $conn->query("SELECT * FROM plan1 WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan1 ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                            <?php if($c['id']!=4){ ?>              
                                            <option value="<?=$c['id']?>" <?php if($row['p1']==$c['id']){ ?> selected <?php } ?> ><?=$c['planned']?></option>                     
                                            <?php } } ?>
                                                                
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <input type='hidden' value="<?php echo $row['p2']; ?>" name='p2_old'  class='form-control'>
                                            <label for="p2" class="col-form-label">แผนการเรียนอันดับที่ 2</label>
                                            <select name="p2" class="form-control" >
                                                <!--<option value="<?php echo $data['p2'] ?> " SELECTED ><?php echo $data['p2'] ?></option>-->
                                            <?php
                                                    $OS = $row['p2'];
                                                    $p = $conn->query("SELECT * FROM plan1 WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan1 ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>              
                                            <option value="<?=$c['id']?>" <?php if($row['p2']==$c['id']){ ?> selected <?php } ?>><?=$c['planned']?></option>                     
                                            <?php } ?>
                                                                
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <input type='hidden' value="<?php echo $row['p3']; ?>" name='p3_old'  class='form-control'>
                                            <label for="p3" class="col-form-label">แผนการเรียนอันดับที่ 3</label>
                                            <select name="p3" class="form-control" >
                                                <!--<option value="<?php echo $data['p3'] ?> " SELECTED ><?php echo $data['p3'] ?></option>-->
                                            <?php
                                                    $OS = $row['p3'];
                                                    $p = $conn->query("SELECT * FROM plan1 WHERE id = $OS ");
                                                    $p ->execute();
                                                    $plann = $p->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            
                                            <?php
                                                $spro = $conn->query("SELECT * FROM plan1 ");
                                                while ($c = $spro->fetch(PDO::FETCH_ASSOC)) {
                                            ?>              
                                            <option value="<?=$c['id']?>" <?php if($row['p3']==$c['id']){ ?> selected <?php } ?>><?=$c['planned']?></option>                     
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
                        <div class="mb-3">
                            <label for="img4" class="form-label">สำเนาทะเบียนบ้าน</label>
                            <h6>ไฟล์เดิม <a href="uploads/<?php echo $row['img_page3']; ?>" target="_blank"> <?php echo $row['img_page3']; ?></a></h6>
                            <input class="form-control" type="file"  id="img4" name="img_page3">
                            <input type="hidden" value="<?php echo $row['img_page3']; ?>" = class="form-control" name="img_page32" >
                        </div>
                    </div>
                                
                    <hr>
                    <a href="signinEdit" class="btn btn-secondary">กลับหน้าหลัก</a>
                    <button type="submit" name="update" class="btn btn-primary">บันทึกข้อมูล</button>
            </form>

            <?php } ?>

        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="assets/url.js"></script>
    <script src="assets/jquery.min.js"></script>
    <script src="assets/script.js"></script>
    <script src="assets/tes.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    
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

<script type="text/javascript">
        $(function() {
            $('#datepicker2').datepicker();
        });
    </script>
</body>
</html>