<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System PDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<header>
  <br><br><br>
</header>
<form action="signin.php" method="post">
<?php 

if (isset($_SESSION['admin_login'])) {
    $admin_id = $_SESSION['admin_login'];
    $stmt = $conn->query("SELECT * FROM admins WHERE id = $admin_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_SESSION['staff_login'])) {
  $staff_id = $_SESSION['staff_login'];
  $stmt = $conn->query("SELECT * FROM admins WHERE id = $staff_id");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

    <header>
      <nav class="navbar navbar-light navbar-dark fixed-top bg-light shadow flex-md-nowrap">
          <div class="container">
          
                
                 <ul class="nav nav-pills"> 
                  <li class="nav-item"> <a href="admin.php" class="btn btn-outline-secondary me-2">Home</a></li>
                
                  <li class="nav-item"><button class="btn btn-secondary dropdown-toggle me-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      ม.1
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li><a class="dropdown-item" href="adminM1Stat0.php?class=1">รายชื่อตรวจสอบ</a></li>
                      <li><a class="dropdown-item" href="adminM1Stat1.php?class=1">รายชื่อที่ยังไม่ผ่าน</a></li>
                      <li><a class="dropdown-item" href="adminM1Stat2.php?class=1">รายชื่อที่ผ่านแล้ว</a></li>
                      <li><a class="dropdown-item" href="#">รายทั้งหมด</a></li>
                    </ul>
                  
                  </li>
                

                  <li class="nav-item"><button class="btn btn-secondary dropdown-toggle me-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      ม.4
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li><a class="dropdown-item" href="adminM1Stat0.php?class=4">รายชื่อตรวจสอบ</a></li>
                      <li><a class="dropdown-item" href="adminM1Stat1.php?class=4">รายชื่อที่ยังไม่ผ่าน</a></li>
                      <li><a class="dropdown-item" href="adminM1Stat2.php?class=4">รายชื่อที่ผ่านแล้ว</a></li>
                      <li><a class="dropdown-item" href="#">รายทั้งหมด</a></li>
                    </ul>
                  
                  </li>
                  <?php if (isset($_SESSION['admin_login'])) { ?>
                  <li class="nav-item"> <a href="adminM1Stat3.php?class=1" class="btn btn-outline-secondary me-2">ตั้งเลขสอบ ม.1</a></li>
                  <li class="nav-item"> <a href="adminM1Stat3.php?class=4" class="btn btn-outline-secondary me-2">ตั้งเลขสอบ ม.4</a></li>
                  <?php } ?>
                  </ul>
                
                  <div class="text-end"><?php echo $row['firstname'] . ' ' . $row['lastname'] ?></div>
                  <a href="logout.php" class="btn btn-outline-danger me-2">Logout</a>
                  
         </div>          

            
      </nav>  
    </header>
      
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>