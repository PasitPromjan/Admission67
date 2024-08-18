<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])&&!isset($_SESSION['staff_login'])) {
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
    <title>admin KP</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Tangerine">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    th
    ,td {
        border: 1px solid rgb(160 160 160);
        padding: 8px 10px;
      }

      th[scope="col"] {
        background-color: #505050;
        color: #fff;
      }

      th[scope="row"] {
        background-color: #d6ecd4;
      }

      tr:nth-of-type(odd) td {
        background-color: #eee;
      }

      

  </style>





</head>
<body class="bg-dark">
  <?php include 'adminHEADBAR.php';?>
  
  <div class="container-fluid">
    <div class="bg-light p-5 rounded">
    
    <?php
          $order = 1;
          if (isset($_GET['class'])) {       
            $class = $_GET['class'];
            }
        ?>
        <main class="col py-3">
            <div class="container">
            <h1 class="text-center mt-3">สรุปจำนวนที่รับสมัคร</h1>
            
            <table class="table table-bordered">
                <tr>
                    <th rowspan="2">วันที่สมัคร</th>
                    <th colspan="2">STEM</th>
                    <th colspan="2">วิทย์</th>
                    <th colspan="2">คณิต</th>
                    <th rowspan="2">สรุป</th>
                </tr>
                <tr>
                    <td>ในเขต</td>
                    <td>นอกเขต</td>
                    <td>ในเขต</td>
                    <td>นอกเขต</td>
                    <td>ในเขต</td>
                    <td>นอกเขต</td>
                </tr>
                <tr>
                    <td>วันที่ 10/02/67 </td>
                    <?php   $result = $conn->query("SELECT COUNT(CASE WHEN p1 = 3 THEN id END) as stem, COUNT(CASE WHEN p1 = 1 THEN id END) as sci, COUNT(CASE WHEN p1 = 2 THEN id END) as math FROM m1 WHERE DATE(sign_when) BETWEEN '2024-02-05' AND '2024-02-10' AND AD_Subdistrict = 709;");
                            $row = $result->fetch(PDO::FETCH_ASSOC); 
                            $result = $conn->query("SELECT COUNT(CASE WHEN p1 = 3 THEN id END) as stem, COUNT(CASE WHEN p1 = 1 THEN id END) as sci, COUNT(CASE WHEN p1 = 2 THEN id END) as math FROM m1 WHERE DATE(sign_when) BETWEEN '2024-02-05' AND '2024-02-10' AND AD_Subdistrict != 709;");
                            $roww = $result->fetch(PDO::FETCH_ASSOC);
                            $stem=0;
                            $sci=0;
                            $math=0;
                            $sum=0;
                            $stem=$stem + $row['stem'] + $roww['stem'] ;
                            $sci=$sci + $row['sci'] + $roww['sci'] ;
                            $math=$math + $row['math'] + $roww['math'] ;
                            $sum=$sum + $roww['sci']+$roww['math']+$roww['stem']+$row['sci']+$row['math']+$row['stem'] ;

                                  
                    ?>
                    <td><?php echo $row['stem'] ?> </td>
                    <td><?php echo $roww['stem'] ?> </td>
                    <td><?php echo $row['math'] ?> </td>
                    <td><?php echo $roww['math'] ?> </td>
                    <td><?php echo $row['sci'] ?> </td>
                    <td><?php echo $roww['sci'] ?> </td>
                    <td><?php echo $roww['sci']+$roww['math']+$roww['stem']+$row['sci']+$row['math']+$row['stem'] ?> </td>
                </tr>
                <tr>
                    <td>วันที่ 11/02/67 </td>
                    <?php   $result = $conn->query("SELECT COUNT(CASE WHEN p1 = 3 THEN id END) as stem, COUNT(CASE WHEN p1 = 1 THEN id END) as sci, COUNT(CASE WHEN p1 = 2 THEN id END) as math FROM m1 WHERE DATE(sign_when)  ='2024-02-11'  AND AD_Subdistrict = 709;");
                            $row = $result->fetch(PDO::FETCH_ASSOC); 
                            $result = $conn->query("SELECT COUNT(CASE WHEN p1 = 3 THEN id END) as stem, COUNT(CASE WHEN p1 = 1 THEN id END) as sci, COUNT(CASE WHEN p1 = 2 THEN id END) as math FROM m1 WHERE DATE(sign_when)  ='2024-02-11'  AND AD_Subdistrict != 709;");
                            $roww = $result->fetch(PDO::FETCH_ASSOC);
                            $stem=$stem + $row['stem'] + $roww['stem'] ;
                            $sci=$sci + $row['sci'] + $roww['sci'] ;
                            $math=$math + $row['math'] + $roww['math'] ;
                            $sum=$sum + $roww['sci']+$roww['math']+$roww['stem']+$row['sci']+$row['math']+$row['stem'] ;

                                  
                    ?>
                    <td><?php echo $row['stem'] ?> </td>
                    <td><?php echo $roww['stem'] ?> </td>
                    <td><?php echo $row['math'] ?> </td>
                    <td><?php echo $roww['math'] ?> </td>
                    <td><?php echo $row['sci'] ?> </td>
                    <td><?php echo $roww['sci'] ?> </td>
                    <td><?php echo $roww['sci']+$roww['math']+$roww['stem']+$row['sci']+$row['math']+$row['stem'] ?> </td>
                </tr>
                <tr>
                    <td>วันที่ 12/02/67 </td>
                    <?php   $result = $conn->query("SELECT COUNT(CASE WHEN p1 = 3 THEN id END) as stem, COUNT(CASE WHEN p1 = 1 THEN id END) as sci, COUNT(CASE WHEN p1 = 2 THEN id END) as math FROM m1 WHERE DATE(sign_when)  ='2024-02-12'  AND AD_Subdistrict = 709;");
                            $row = $result->fetch(PDO::FETCH_ASSOC); 
                            $result = $conn->query("SELECT COUNT(CASE WHEN p1 = 3 THEN id END) as stem, COUNT(CASE WHEN p1 = 1 THEN id END) as sci, COUNT(CASE WHEN p1 = 2 THEN id END) as math FROM m1 WHERE DATE(sign_when)  ='2024-02-12'  AND AD_Subdistrict != 709;");
                            $roww = $result->fetch(PDO::FETCH_ASSOC);
                            $stem=$stem + $row['stem'] + $roww['stem'] ;
                            $sci=$sci + $row['sci'] + $roww['sci'] ;
                            $math=$math + $row['math'] + $roww['math'] ;
                            $sum=$sum + $roww['sci']+$roww['math']+$roww['stem']+$row['sci']+$row['math']+$row['stem'] ;

                                  
                    ?>
                    <td><?php echo $row['stem'] ?> </td>
                    <td><?php echo $roww['stem'] ?> </td>
                    <td><?php echo $row['math'] ?> </td>
                    <td><?php echo $roww['math'] ?> </td>
                    <td><?php echo $row['sci'] ?> </td>
                    <td><?php echo $roww['sci'] ?> </td>
                    <td><?php echo $roww['sci']+$roww['math']+$roww['stem']+$row['sci']+$row['math']+$row['stem'] ?> </td>
                </tr>
                <tr>
                    <td>วันที่ 13/02/67 </td>
                    <?php   $result = $conn->query("SELECT COUNT(CASE WHEN p1 = 3 THEN id END) as stem, COUNT(CASE WHEN p1 = 1 THEN id END) as sci, COUNT(CASE WHEN p1 = 2 THEN id END) as math FROM m1 WHERE DATE(sign_when)  ='2024-02-13'  AND AD_Subdistrict = 709;");
                            $row = $result->fetch(PDO::FETCH_ASSOC); 
                            $result = $conn->query("SELECT COUNT(CASE WHEN p1 = 3 THEN id END) as stem, COUNT(CASE WHEN p1 = 1 THEN id END) as sci, COUNT(CASE WHEN p1 = 2 THEN id END) as math FROM m1 WHERE DATE(sign_when)  ='2024-02-13'  AND AD_Subdistrict != 709;");
                            $roww = $result->fetch(PDO::FETCH_ASSOC);
                            $stem=$stem + $row['stem'] + $roww['stem'] ;
                            $sci=$sci + $row['sci'] + $roww['sci'] ;
                            $math=$math + $row['math'] + $roww['math'] ;
                            $sum=$sum + $roww['sci']+$roww['math']+$roww['stem']+$row['sci']+$row['math']+$row['stem'] ;

                                  
                    ?>
                    <td><?php echo $row['stem'] ?> </td>
                    <td><?php echo $roww['stem'] ?> </td>
                    <td><?php echo $row['math'] ?> </td>
                    <td><?php echo $roww['math'] ?> </td>
                    <td><?php echo $row['sci'] ?> </td>
                    <td><?php echo $roww['sci'] ?> </td>
                    <td><?php echo $roww['sci']+$roww['math']+$roww['stem']+$row['sci']+$row['math']+$row['stem'] ?> </td>
                </tr>
                <tr>
                    <td>วันที่ 14/02/67 </td>
                    <?php   $result = $conn->query("SELECT COUNT(CASE WHEN p1 = 3 THEN id END) as stem, COUNT(CASE WHEN p1 = 1 THEN id END) as sci, COUNT(CASE WHEN p1 = 2 THEN id END) as math FROM m1 WHERE DATE(sign_when)  ='2024-02-14'  AND AD_Subdistrict = 709;");
                            $row = $result->fetch(PDO::FETCH_ASSOC); 
                            $result = $conn->query("SELECT COUNT(CASE WHEN p1 = 3 THEN id END) as stem, COUNT(CASE WHEN p1 = 1 THEN id END) as sci, COUNT(CASE WHEN p1 = 2 THEN id END) as math FROM m1 WHERE DATE(sign_when)  ='2024-02-14'  AND AD_Subdistrict != 709;");
                            $roww = $result->fetch(PDO::FETCH_ASSOC);
                            $stem=$stem + $row['stem'] + $roww['stem'] ;
                            $sci=$sci + $row['sci'] + $roww['sci'] ;
                            $math=$math + $row['math'] + $roww['math'] ;
                            $sum=$sum + $roww['sci']+$roww['math']+$roww['stem']+$row['sci']+$row['math']+$row['stem'] ;

                                  
                    ?>
                    <td><?php echo $row['stem'] ?> </td>
                    <td><?php echo $roww['stem'] ?> </td>
                    <td><?php echo $row['math'] ?> </td>
                    <td><?php echo $roww['math'] ?> </td>
                    <td><?php echo $row['sci'] ?> </td>
                    <td><?php echo $roww['sci'] ?> </td>
                    <td><?php echo $roww['sci']+$roww['math']+$roww['stem']+$row['sci']+$row['math']+$row['stem'] ?> </td>
                </tr>
                <tr>
                    <td >สรุป</td>
                    <td colspan="2"><?php echo $stem; ?></td>
                    <td colspan="2"><?php echo $sci; ?></td>
                    <td colspan="2"><?php echo $math; ?></td>
                    <td ><?php echo $sum; ?> </td>
                </tr>
                </table>    
                <br><br>


                <table class="table table-bordered">
                <tr>
                    <th >วันที่สมัคร</th>
                    <th> รร. เดิม </th>
                    <th> รร. อื่น</th>
                    <th >สรุป</th>
                </tr>
                
                <tr>
                    <td>วันที่ 10/02/67 </td>
                    <?php   $result = $conn->query("SELECT COUNT(id) as sp FROM m4 WHERE DATE(sign_when) BETWEEN '2024-02-05' AND '2024-02-10' AND oldschool='กำแพงเพชรพิทยาคม';");
                            $row = $result->fetch(PDO::FETCH_ASSOC); 
                            $result = $conn->query("SELECT COUNT(id) as sp FROM m4 WHERE DATE(sign_when) BETWEEN '2024-02-05' AND '2024-02-10' AND oldschool!='กำแพงเพชรพิทยาคม';");
                            $roww = $result->fetch(PDO::FETCH_ASSOC);
                            $sp1=0;
                            $sp2=0;
                            $sum=0;
                            $sp1 = $sp1 + $row['sp'];
                            $sp2 = $sp2 + $roww['sp'];
                            
                            $sum=$sum + $row['sp'] + $roww['sp'] ;

                                  
                    ?>
                    
                    <td><?php echo $row['sp'] ?> </td>
                    <td><?php echo $roww['sp'] ?> </td>
                    <td><?php echo $row['sp'] + $roww['sp'] ?> </td>
                </tr>
                <tr>
                    <td>วันที่ 11/02/67 </td>
                    <?php   $result = $conn->query("SELECT COUNT(id) as sp FROM m4 WHERE DATE(sign_when)  ='2024-02-11'  AND oldschool='กำแพงเพชรพิทยาคม';");
                            $row = $result->fetch(PDO::FETCH_ASSOC); 
                            $result = $conn->query("SELECT COUNT(id) as sp FROM m4 WHERE DATE(sign_when)  ='2024-02-11'  AND oldschool!='กำแพงเพชรพิทยาคม';");
                            $roww = $result->fetch(PDO::FETCH_ASSOC);
                            $sp1 = $sp1 + $row['sp'];
                            $sp2 = $sp2 + $roww['sp'];
                            
                            
                            $sum=$sum + $row['sp'] + $roww['sp'] ;

                                  
                    ?>
                    
                    <td><?php echo $row['sp'] ?> </td>
                    <td><?php echo $roww['sp'] ?> </td>
                    <td><?php echo $row['sp'] + $roww['sp'] ?> </td>
                </tr>
                <tr>
                    <td>วันที่ 12/02/67 </td>
                    <?php   $result = $conn->query("SELECT COUNT(id) as sp FROM m4 WHERE DATE(sign_when)  ='2024-02-12'  AND oldschool='กำแพงเพชรพิทยาคม';");
                            $row = $result->fetch(PDO::FETCH_ASSOC); 
                            $result = $conn->query("SELECT COUNT(id) as sp FROM m4 WHERE DATE(sign_when)  ='2024-02-12'  AND oldschool!='กำแพงเพชรพิทยาคม';");
                            $roww = $result->fetch(PDO::FETCH_ASSOC);
                            $sp1 = $sp1 + $row['sp'];
                            $sp2 = $sp2 + $roww['sp'];
                            
                            
                            $sum=$sum + $row['sp'] + $roww['sp'] ;

                                  
                    ?>
                    
                    <td><?php echo $row['sp'] ?> </td>
                    <td><?php echo $roww['sp'] ?> </td>
                    <td><?php echo $row['sp'] + $roww['sp'] ?> </td>
                </tr>
                <tr>
                    <td>วันที่ 13/02/67 </td>
                    <?php   $result = $conn->query("SELECT COUNT(id) as sp FROM m4 WHERE DATE(sign_when)  ='2024-02-13'  AND oldschool='กำแพงเพชรพิทยาคม';");
                            $row = $result->fetch(PDO::FETCH_ASSOC); 
                            $result = $conn->query("SELECT COUNT(id) as sp FROM m4 WHERE DATE(sign_when)  ='2024-02-13'  AND oldschool!='กำแพงเพชรพิทยาคม';");
                            $roww = $result->fetch(PDO::FETCH_ASSOC);
                            $sp1 = $sp1 + $row['sp'];
                            $sp2 = $sp2 + $roww['sp'];
                            
                            
                            $sum=$sum + $row['sp'] + $roww['sp'] ;

                                  
                    ?>
                    
                    <td><?php echo $row['sp'] ?> </td>
                    <td><?php echo $roww['sp'] ?> </td>
                    <td><?php echo $row['sp'] + $roww['sp'] ?> </td>
                </tr>
                <tr>
                    <td>วันที่ 14/02/67 </td>
                    <?php   $result = $conn->query("SELECT COUNT(id) as sp FROM m4 WHERE DATE(sign_when)  ='2024-02-14'  AND oldschool='กำแพงเพชรพิทยาคม';");
                            $row = $result->fetch(PDO::FETCH_ASSOC); 
                            $result = $conn->query("SELECT COUNT(id) as sp FROM m4 WHERE DATE(sign_when)  ='2024-02-14'  AND oldschool!='กำแพงเพชรพิทยาคม';");
                            $roww = $result->fetch(PDO::FETCH_ASSOC);
                            $sp1 = $sp1 + $row['sp'];
                            $sp2 = $sp2 + $roww['sp'];
                            
                            
                            $sum=$sum + $row['sp'] + $roww['sp'] ;

                                  
                    ?>
                    
                    <td><?php echo $row['sp'] ?> </td>
                    <td><?php echo $roww['sp'] ?> </td>
                    <td><?php echo $row['sp'] + $roww['sp'] ?> </td>
                </tr>
                <tr>
                    <td >สรุป</td>
                    <td ><?php echo $sp1; ?></td>
                    <td ><?php echo $sp2; ?></td>
                
                    <td ><?php echo $sum; ?> </td>
                </tr>
                </table>   


          </main>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>
</html>