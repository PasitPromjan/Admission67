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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="theme-color" content="#7952b3">
</head>
<body>
  <?php include 'adminHEADBAR.php';?>
  
  <div class="container-fluid">
    <div class="row flex-nowrap">
      <?php include 'adminSIDEBAR.php';?>  
    

        <main class="col py-3">
            <div class="container">
            <h1 class="text-center mt-3">รายชื่อเจ้าหน้าที่</h1>
            <table class="table table-bordered">
              <thead class="table-dark">
                <tr>
                  <th>#</th>
                  <th>ชื่อ</th>
                  <th>สกุล</th>
                  <th>เลขบัตรประชาชน</th>
                  <th>เลขประจำตัวนักเรียน</th>
                  <th> </th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    $stmt = $conn->query("SELECT * FROM users WHERE urole='staff' ORDER BY class");
                    $stmt->execute();
                    $users = $stmt->fetchAll();

                    if (!$users) {
                        echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
                    } else {
                    foreach($users as $user)  {  
                ?>
                    <tr>
                        <th scope="row"><?php echo $user['id']; ?></th>
                        <td><?php echo $user['firstname']; ?></td>
                        <td><?php echo $user['lastname']; ?></td>
                        <td><?php echo $user['pid']; ?></td>
                        <td><?php echo $user['stid']; ?></td>
                        <td>
                            <a href="adminStaffEdit.php?id=<?php echo  $user['id']; ?>" class="btn btn-warning">แก้ไข</a>
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