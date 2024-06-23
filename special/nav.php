<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System PDO</title>
    <link rel="icon" href="logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<header>
  <br><br><br>
</header>

<?php 
  $stmt = $conn->query("SELECT * FROM exist WHERE id=1");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
  <header>
    <nav class="main-header navbar navbar-expand-md navbar-dark bg-light fixed-top flex-md-nowrap"> 
   
   <div class="container">
   <a href="index" class="navbar-brand">
   <img src="logo.png" alt=" School Logo" class="brand-image" style="opacity: .8" height="30">
   <span class="brand-text font-weight-light d-none d-sm-inline-block text-dark"> ระบบรับสมัครนักเรียน โรงเรียนกำแพงเพชรพิทยาคม
   ปีการศึกษา 2567
   </span>
   </a>
   
   <div class="text-end">
   <a href="signin" class="btn btn-outline-danger me-2">ตรวจสอบการสมัคร</a>
   <?php if($row['edits']==1){ ?>
   <a href="signinEdit" class="btn btn-outline-warning me-2">แก้ไขข้อมูลการสมัคร</a>
   <?php } ?>
   <?php if($row['prints']==1){ ?>
   <a href="signinTest" class="btn btn-outline-primary me-2">พิมพ์บัตรประจำตัวสอบ</a>
   <?php } ?>
    </div>
            
   </div>
   </nav>       
      </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    
</body>
</html>