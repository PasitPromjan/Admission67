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

    <header>
      <nav class="navbar navbar-light navbar-dark fixed-top bg-light shadow flex-md-nowrap">
        <?php
        if (isset($_SESSION['user_login'])) {
            $user_id = $_SESSION['user_login'];
            $stmt = $conn->query("SELECT * FROM m4 WHERE id = $user_id");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        ?>
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
              <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <span class="px-2 fs-4">โรงเรียนกำแพงเพชรพิทยาคม</span>
              <li><a href="index.php" class="nav-link px-2 text-secondary">ระบบรับสมัครนักเรียนเข้าศึกษาต่อระดับชั้นมัธยมศึกษาปีที่ 4 ปีการศึกษา 2567 </a></li>
            </ul>

            
            <?php if($row['stat']=='0'){ 
                  echo '<span class="badge bg-warning me-4">รอการตรวจสอบจากเจ้าหน้าที่</span>';
                } 
                  else if ($row['stat']=='1'){
                    echo ' <span class="badge bg-danger me-4">ข้อมูลไม่ถูกต้อง</span>';
                } 
                  else if($row['stat']=='2'){
                    echo ' <span class="badge bg-success me-4">เรียบร้อยแล้ว รอประกาศเลขที่นั่งสอบ</span>';
                }
                  else if($row['stat']=='3'){
                    echo 'ยืนยันแล้ว รอประกาศเลขที่นั่งสอบ';
                }
                  else if($row['stat']=='4'){
                    echo 'ออกเลขที่นั่งสอบแล้ว';
                }
                
              ?>
            
            <div class="dropdown">
              <button type="button" class="btn btn-outline-danger dropdown-toggle" data-bs-toggle="dropdown">
                
              </button>
              <ul class="dropdown-menu ">
                <li><a class="dropdown-item " href="user.php">ข้อมูลของฉัน</a></li>
                <li><a class="dropdown-item" href="useredit.php">แก้ไขข้อมูล</a></li>
                <li><a class="dropdown-item" href="logout.php">ออกจากระบบ</a></li>
              </ul>
            </div>
            
            <div class="text-end">
              <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-dark" href="#"><?php echo $row['firstname'] . ' ' . $row['lastname'] ?></a>
              <!--<a href="user.php" class="btn btn-outline-danger me-2">data</a>
              <a href="logout.php" class="btn btn-outline-danger me-2">Logout</a>-->
              
            </div>        

            
      </nav>  
    </header>
      
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>