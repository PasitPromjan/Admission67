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
            <h1 class="text-center mt-3">รายชื่อนักเรียน ที่พร้อมตั้งเลขที่นั่งสอบ</h1>
            <form action=" adminM1Stat3search.php?class=<?php echo $class; ?>" class="form-group my-3" method="POST">
              <div class="row">
                <div class="col-6">
                  <input type="text" placeholder="กรอกชื่อนักเรียน" class="form-control" name="data" required>
                </div>
                <div class="col-1">
                  <input type="submit" value="ค้นหา" class="btn btn-info">
                </div>
                <div class="col-3">
                    <a href="adminM1Stat3set.php?class=<?php echo  $class?>" class="btn btn-warning ">ตั้งเลขประจำตัวสอบ</a>
                </div>
              </div>

            </form>
            <table class="table table-bordered">
              <thead class="table-dark">
                <tr>
                  <th>#</th>
                  <th>เลขที่นั่งสอบ </th>
                  <th>ห้องสอบ</th>
                  <th>คำนำหน้าชื่อ-สกุล</th>
                  <th>โรงเรียน</th>
                  <th>เลขบัตรประชาชน</th>
                  <th>จังหวัด</th>
                  <th>อำเภอ</th>
                  <th>ตำบล</th>
                  <th>เบอร์นักเรียน</th>
                  <th>เบอร์ผู้ปกครอง</th>

                  <th> </th>
                </tr>
              </thead>
              <tbody>
              <?php if (isset($_GET['class'])) {
                        
                        $class = $_GET['class'];
                        if($class == "4"){
                            $stmt = $conn->query("SELECT * FROM m4 WHERE ((stat='2' or stat='3') and urole='user') ORDER BY firstname");
                            $stmt->execute();
                        }
                        else if($class == "1"){
                            $stmt = $conn->query("SELECT * FROM m1 WHERE ((stat='2' or stat='3') and urole='user') ORDER BY firstname");
                            $stmt->execute();
                        }
                        $users = $stmt->fetchAll();
                      }

                    if (!$users) {
                        echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
                    } else {
                    foreach($users as $user)  {  
                ?>
                    <tr>
                        <td><?php echo $order++; ?></td>
                        <td><?php echo $user['test_id']; ?></td>
                        <?php
                            if($class== "4"){                      
                            $prov = $conn->query("SELECT * FROM test4_room ");
                            }
                            if($class== "1"){                      
                              $prov = $conn->query("SELECT * FROM test1_room ");
                              }
                            while ($result = $prov->fetch(PDO::FETCH_ASSOC)) {
                              if( $result['id']== $user['test_room']){
                        ?>
                        <td><?php echo $result['room']; ?> </td>    
                        <?php } } ?>
                        <td><?php echo $user['title'].$user['firstname']." ".$user['lastname']; ?></td>
                        <td><?php echo $user['oldschool']; ?></td>
                        <td><?php echo $user['pid']; ?></td>
                        <?php
                            $prov = $conn->query("SELECT * FROM provinces ");
                            while ($result = $prov->fetch(PDO::FETCH_ASSOC)) {
                              if( $result['id']== $user['AD_Province']){
                        ?>
                        <td><?php echo $result['name_th']; ?> </td>    
                        <?php } } ?>
                        <?php
                            $prov = $conn->query("SELECT * FROM amphures ");
                            while ($result = $prov->fetch(PDO::FETCH_ASSOC)) {
                              if( $result['id']== $user['AD_Subdistrict']){
                        ?>
                        <td><?php echo $result['name_th']; ?> </td>    
                        <?php } } ?>
                        <?php
                            $prov = $conn->query("SELECT * FROM districts ");
                            while ($result = $prov->fetch(PDO::FETCH_ASSOC)) {
                              if( $result['id']== $user['AD_District']){
                        ?>
                        <td><?php echo $result['name_th']; ?> </td>    
                        <?php } } ?>
                        <td><?php echo $user['StPN']; ?></td>
                        <td><?php echo $user['PaPN']; ?></td>

                        <td>
                        <?php 
                              $query = array(
                                'id' => $user['id'], 
                                'class' => $class
                                );
                            
                            $query = http_build_query($query);
                            ?>
                            <a href="adminUserData.php?<?php echo  $query?>" class="btn btn-success">แก้ไข</a>
                        </td>
                      </tr>
                <?php }  } ?>
            </tbody>
            </table>
          </main>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>
</html>