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
    <title>User Page</title>
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
        
        ?>
        <main class="col py-3">
            <div class="container">
            <h1 class="text-center mt-3">รายชื่อนักเรียนสมัคร รอการตรวจสอบ</h1>
            <form action=" adminM1Stat1search.php" class="form-group my-3" method="POST">
              <div class="row">
                <div class="col-6">
                  <input type="text" placeholder="กรอกชื่อนักเรียน" class="form-control" name="data" required>
                </div>
                <div class="col-6">
                  <input type="submit" value="ค้นหา" class="btn btn-info">
                </div>
              </div>

            </form>
            <table class="table table-bordered">
              <thead class="table-dark">
                <tr>
                  <th>#</th>

                  <th>ชื่อ</th>
                  <th>สกุล</th>
                  <th>เลขบัตรประชาชน</th>
                  <th>จังหวัด</th>
                  <th>อำเภอ</th>
                  <th>ตำบล</th>

                  <th> </th>
                  <th>ตรวจโดย</th>
                </tr>
              </thead>
              <tbody>
              <?php if (isset($_GET['class'])) {
                        
                        $class = $_GET['class'];
                        if($class == "4"){
                            $stmt = $conn->query("SELECT * FROM m4 WHERE (stat='1' and urole='user')");
                            $stmt->execute();
                        }
                        else if($class == "1"){
                            $stmt = $conn->query("SELECT * FROM m1 WHERE (stat='1' and urole='user')");
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

                        <td><?php echo $user['firstname']; ?></td>
                        <td><?php echo $user['lastname']; ?></td>
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

                        <td>
                        <?php 
                              $query = array(
                                'id' => $user['id'], 
                                'class' => $class
                                );
                            
                            $query = http_build_query($query);
                            ?>
                            <a href="adminUserData.php?<?php echo  $query?>" class="btn btn-success">แก้ไข</a>
                        <a href="adminallow.php?<?php echo  $query; ?>" class="btn btn-primary">ตรวจสอบ</a>
                        </td>
                        <td><?php echo $user['checkby']; ?></td>
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