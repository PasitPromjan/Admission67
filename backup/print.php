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
    <style type="text/css"> 

    #printable { display: block; }

    @media print 
    { 
        #non-printable { display: none; } 
        #printable { display: block; } 
    } 

    </style> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="print.css">

    <!--<style>
        table, th, td {
        border:1px solid black;
        border-spacing:2px;

        }
    </style>-->
</head>
<body style="background-color: #910000;">
<div id="non-printable"><?php include 'navB.php';?></div>
    
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
                    } ?>
            <?php if (isset($_GET['id'])&&isset($_GET['class'])) {  ?>
                <br>
                <div id="non-printable"><center><input type='button' class="btn btn-light" value='พิมพ์ข้อมูล' onclick='print()'></center></div>
                        
                    
                    <div class="main-page bg-light">

                            
                            <div id="printable">
                                <br>
                                

                                    <table align="left">
                                        
                                            <tr>
                                                <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img height="100px" src="icon.png">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td ><h4 class="text-primary">บัตรประจำตัวสอบ </h4> <h5> เข้าศึกษาต่อระดับชั้นมัธยมศึกษาปีที่ <?php echo $class."&nbsp;&nbsp; " ?><v class="text-success">ประเภทห้องเรียนพิเศษ</v><br>โรงเรียนกำแพงเพชรพิทยาคม &nbsp;&nbsp; ปีการศึกษา 2567</h5></td>
                                                
                                            </tr> 
                                            <tr>
                                                <td></td>
                                                <td><p></td>
                                            </tr> 
                                    </table>
                                
                                  
                                <table width="95%" align="center">
                                    <tr>
                                    <td>
                                    <table border="2px" width="99%" align="left">
                                        <tr>
                                        <td>
                                            <table width="95%" align="center">
                                                <tr>
                                                    <td><b>เลขที่นั่งสอบ : </b><a><?php echo $row['test_id'] ?></a></td>
                                                    <?php
                                                        if($class== "4"){                      
                                                        $prov = $conn->query("SELECT * FROM test4_room ");
                                                        }
                                                        if($class== "1"){                      
                                                        $prov = $conn->query("SELECT * FROM test1_room ");
                                                        }
                                                        while ($result = $prov->fetch(PDO::FETCH_ASSOC)) {
                                                        if( $result['id']== $row['test_room']){
                                                    ?>
                                                    <td><b>ห้องสอบ : </b><?php echo $result['room']; ?> </td>    
                                                    <?php } } ?>
                                                    <td><b>เลขบัตรประชาชน : </b><?php echo $row['pid'] ?></td>
                                                    
                                                </tr>   
                                            </table>
                                            <p>
                                            <table width="95%" align="center">
                                                <tr>
                                                    <td><b>ชื่อ-สกุล : </b><?php echo $row['title'].$row['firstname']."&nbsp;&nbsp; ".$row['lastname']; ?></th>
                                                </tr>
                                                <tr><td><b>โรงเรียน : </b><?php echo $row['oldschool'] ?></td></tr>
                                            </table>
                                            <table width="95%" align="center">
                                                <tr valign="top">
                                                    <td width="30%"><b>ที่อยู่ตามทะเบียนบ้าน : </b></td>
                                                    <td width="70%">
                                                        <?php echo $row['address']; ?>
                                                        <br>
                                                        <?php
                                                            
                                                            $prov = $conn->query("SELECT * FROM districts ");
                                                            while ($result = $prov->fetch(PDO::FETCH_ASSOC)) {
                                                        ?>
                                                        <?php if( $result['id']== $row['AD_District']){echo "ตำบล ".$result['name_th'];} ?>
                                                        <?php } ?>
                                                        <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                                                        <?php
                                                            
                                                            $prov = $conn->query("SELECT * FROM amphures ");
                                                            while ($result = $prov->fetch(PDO::FETCH_ASSOC)) {
                                                        ?>
                                                        <?php if( $result['id']== $row['AD_Subdistrict']){echo "อำเภอ  ".$result['name_th'];} ?>
                                                        <?php } ?>
                                                        <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                                                        <?php
                                                            
                                                            $prov = $conn->query("SELECT * FROM provinces ");
                                                            while ($result = $prov->fetch(PDO::FETCH_ASSOC)) {
                                                        ?>
                                                        <?php if( $result['id']== $row['AD_Province']){echo "จังหวัด ".$result['name_th'];} ?>
                                                        <?php } ?>
                                                        
                                                    </td>
                                                </tr> 
                                            </table> 
                                            
                                        </tr>
                                        </td>
                                    </table>
                                                                
                                    </td>
                                    <td width="16%"><div align="right"><img height="150px " src="uploads/<?php echo $row['img']; ?>"></div>   </td>
                                    </tr>
                                    
                                </table>
                                <p>
                                            <?php if ($class=="1"){ ?>
                                                <table width="95%" align="center">
                                                    <tr>
                                                        <th colspan="2"><b>&nbsp;&nbsp;&nbsp;แผนการเรียนที่เลือก : </b></th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <?php
                                                                include("config/db.php");
                                                                $p = $conn->query("SELECT * FROM plan1 ");
                                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                            <?php if( $plann['id']== $row['p1']){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>อันดับที่ 1 : </b>".$plann['planned'];} ?>
                                                            <?php } ?>
                                                            <br>
                                                            <?php
                                                                include("config/db.php");
                                                                $p = $conn->query("SELECT * FROM plan1 ");
                                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                            <?php if( $plann['id']== $row['p2']){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> อันดับที่ 2 : </b>".$plann['planned'];} ?>
                                                            <?php } ?>
                                                            <br>
                                                            <?php
                                                                include("config/db.php");
                                                                $p = $conn->query("SELECT * FROM plan1");
                                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                            <?php if( $plann['id']== $row['p3']){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> อันดับที่ 3 : </b>".$plann['planned'];} ?>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                </table>  
                                            <?php }else if($class=="4"){ ?>
                                                <table width="95%" align="center">
                                                    <tr>
                                                        <th colspan="2"><b>&nbsp;&nbsp;&nbsp;แผนการเรียนที่เลือก : </b></th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <?php
                                                                include("config/db.php");
                                                                $p = $conn->query("SELECT * FROM plan4 ");
                                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                            <?php if( $plann['id']== $row['p1']){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>อันดับที่ 1 : </b>".$plann['planned'];} ?>
                                                            <?php } ?>
                                                            <br>
                                                            <?php
                                                                include("config/db.php");
                                                                $p = $conn->query("SELECT * FROM plan4 ");
                                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                            <?php if( $plann['id']== $row['p2']){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> อันดับที่ 2 : </b>".$plann['planned'];} ?>
                                                            <?php } ?>
                                                            <br>
                                                            <?php
                                                                include("config/db.php");
                                                                $p = $conn->query("SELECT * FROM plan4");
                                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                            <?php if( $plann['id']== $row['p3']){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> อันดับที่ 3 : </b>".$plann['planned'];} ?>
                                                            <?php } ?>
                                                            <br>
                                                            <?php
                                                                include("config/db.php");
                                                                $p = $conn->query("SELECT * FROM plan4");
                                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                            <?php if( $plann['id']== $row['p4']){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> อันดับที่ 4 : </b>".$plann['planned'];} ?>
                                                            <?php } ?>
                                                            <br>
                                                            <?php
                                                                include("config/db.php");
                                                                $p = $conn->query("SELECT * FROM plan4");
                                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                            <?php if( $plann['id']== $row['p5']){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> อันดับที่ 5 : </b>".$plann['planned'];} ?>
                                                            <?php } ?>
                                                            <br>
                                                            <?php
                                                                include("config/db.php");
                                                                $p = $conn->query("SELECT * FROM plan4");
                                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                            <?php if( $plann['id']== $row['p6']){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> อันดับที่ 6 : </b>".$plann['planned'];} ?>
                                                            <?php } ?>
                                                            
                                                        </td>
                                                        <td>
                                                            <?php
                                                                include("config/db.php");
                                                                $p = $conn->query("SELECT * FROM plan4 ");
                                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                            <?php if( $plann['id']== $row['p7']){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>อันดับที่ 7 : </b>".$plann['planned'];} ?>
                                                            <?php } ?>
                                                            <br>
                                                            <?php
                                                                include("config/db.php");
                                                                $p = $conn->query("SELECT * FROM plan4 ");
                                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                            <?php if( $plann['id']== $row['p8']){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> อันดับที่ 8 : </b>".$plann['planned'];} ?>
                                                            <?php } ?>
                                                            <br>
                                                            <?php
                                                                include("config/db.php");
                                                                $p = $conn->query("SELECT * FROM plan4");
                                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                            <?php if( $plann['id']== $row['p9']){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> อันดับที่ 9 : </b>".$plann['planned'];} ?>
                                                            <?php } ?>
                                                            <br>
                                                            <?php
                                                                include("config/db.php");
                                                                $p = $conn->query("SELECT * FROM plan4");
                                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                            <?php if( $plann['id']== $row['p10']){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> อันดับที่ 10 : </b>".$plann['planned'];} ?>
                                                            <?php } ?>
                                                            <br>
                                                            <?php
                                                                include("config/db.php");
                                                                $p = $conn->query("SELECT * FROM plan4");
                                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                            <?php if( $plann['id']== $row['p11']){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> อันดับที่ 11 : </b>".$plann['planned'];} ?>
                                                            <?php } ?>
                                                            <br>
                                                            <?php
                                                                include("config/db.php");
                                                                $p = $conn->query("SELECT * FROM plan4");
                                                                while ($plann = $p->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                            <?php if( $plann['id']== $row['p12']){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> อันดับที่ 12 : </b>".$plann['planned'];} ?>
                                                            <?php } ?>
                                                            
                                                        </td>
                                                    </tr>
                                                </table>  
                                            <?php } ?>
                                            <hr border="2px"> 
                            </div>     
                        
                    </div>
                

            <?php } ?>
        

    
    
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
</body>
</html>