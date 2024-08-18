<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])&&!isset($_SESSION['staff_login'])) {
      $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
      header('location: signin.php');
  }

  if (isset($_GET['delete'])) {
    if($_GET['class'] == '1'){
    $delete_id = $_GET['delete'];
    $deletestmt = $conn->query("DELETE FROM m1 WHERE id = $delete_id");
    $deletestmt->execute();
    }
    if($_GET['class'] == '4'){
      $delete_id = $_GET['delete'];
      $deletestmt = $conn->query("DELETE FROM m4 WHERE id = $delete_id");
      $deletestmt->execute();
      }


    if ($deletestmt) {
          $query = array(

            'class' => $_GET['class']
            );
        
        $query = http_build_query($query);
        echo "<script>alert('Data has been deleted successfully');</script>";
        header("refresh:1; url=adminM1Stat2.php?$query");
    }
    
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
  
        <?php
            $order = 1;
            $class = isset($_GET['class']) ? $_GET['class'] : null;
            if ($class == "4") {
                $stmt = $conn->query("SELECT * FROM m4 WHERE (stat='2' OR stat='3') AND urole='user' ORDER BY firstname");
            } elseif ($class == "1") {
                $stmt = $conn->query("SELECT * FROM m1 WHERE (stat='2' OR stat='3') AND urole='user' ORDER BY firstname");
            } else {
                $stmt = $conn->query("SELECT * FROM m4 WHERE 1=0");
            }

            $users = $stmt->fetchAll();
        ?>

            <div class="container-fluid">
                <div class="bg-light p-5 rounded">
                    <main class="col py-3">
                        <h1 class="text-center mt-3">รายชื่อนักเรียนที่ผ่านการตรวจสอบ</h1>
                        <form action="adminM1Stat2search.php?class=<?php echo htmlspecialchars($class); ?>" class="form-group my-3" method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <input type="text" placeholder="กรอกชื่อนักเรียน" class="form-control" name="data" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" value="ค้นหา" class="btn btn-info w-100">
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>เลขประจำตัวสอบ</th>
                                        <th>ห้องสอบที่</th>
                                        <th>ห้องสอบ</th>
                                        <th>คำนำหน้า</th>
                                        <th>ชื่อ</th>
                                        <th>สกุล</th>
                                        <th>โรงเรียน</th>
                                        <th>เลขบัตรประชาชน</th>
                                        <th>วันเกิด</th>
                                        <th>ที่อยู่</th>
                                        <th>จังหวัด</th>
                                        <th>อำเภอ</th>
                                        <th>ตำบล</th>
                                        <?php if ($class == "4") : ?>
                                            <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                <th>แผนการเรียนที่ <?php echo $i; ?></th>
                                            <?php endfor; ?>
                                        <?php elseif ($class == "1") : ?>
                                            <?php for ($i = 1; $i <= 3; $i++) : ?>
                                                <th>แผนการเรียนที่ <?php echo $i; ?></th>
                                            <?php endfor; ?>
                                        <?php endif; ?>
                                        <th>ชื่อผู้ปกครอง</th>
                                        <th>เบอร์นักเรียน</th>
                                        <th>เบอร์ผู้ปกครอง</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!$users) : ?>
                                        <tr>
                                            <td colspan="16" class="text-center">No data available</td>
                                        </tr>
                                    <?php else : ?>
                                        <?php foreach ($users as $user) : ?>
                                            <tr>
                                                <td><?php echo $order++; ?></td>
                                                <td><?php echo ($user['test_id']); ?></td>
                                                <td><?php echo ($user['test_room']); ?></td>
                                                <?php
                                                $roomQuery = $conn->query("SELECT * FROM test" . ($class) . "_room WHERE id=" . intval($user['test_room']));
                                                $room = $roomQuery->fetch(PDO::FETCH_ASSOC);
                                                ?>
                                                <td><?php echo ($room['room']); ?></td>
                                                <td><?php echo ($user['title']); ?></td>
                                                <td><?php echo ($user['firstname']); ?></td>
                                                <td><?php echo ($user['lastname']); ?></td>
                                                <td><?php echo ($user['oldschool']); ?></td>
                                                <td><?php echo ($user['pid']); ?></td>
                                                <td><?php echo ($user['date']); ?></td>
                                                <td><?php echo ($user['address']); ?></td>
                                                <?php
                                                $provinceQuery = $conn->query("SELECT * FROM provinces WHERE id=" . intval($user['AD_Province']));
                                                $province = $provinceQuery->fetch(PDO::FETCH_ASSOC);
                                                ?>
                                                <td><?php echo ($province['name_th']); ?></td>
                                                <?php
                                                $amphureQuery = $conn->query("SELECT * FROM amphures WHERE id=" . intval($user['AD_Subdistrict']));
                                                $amphure = $amphureQuery->fetch(PDO::FETCH_ASSOC);
                                                ?>
                                                <td><?php echo ($amphure['name_th']); ?></td>
                                                <?php
                                                $districtQuery = $conn->query("SELECT * FROM districts WHERE id=" . intval($user['AD_District']));
                                                $district = $districtQuery->fetch(PDO::FETCH_ASSOC);
                                                ?>
                                                <td><?php echo ($district['name_th']); ?></td>
                                                <?php if ($class == "1") : ?>
                                                    <?php for ($i = 1; $i <= 3; $i++) : ?>
                                                        <?php
                                                        $planQuery = $conn->query("SELECT * FROM plan1 WHERE id=" . intval($user['p' . $i]));
                                                        $plan = $planQuery->fetch(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <td><?php echo ($plan['planned']); ?></td>
                                                    <?php endfor; ?>
                                                <?php elseif ($class == "4") : ?>
                                                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                        <?php
                                                        $planQuery = $conn->query("SELECT * FROM plan4 WHERE id=" . intval($user['p' . $i]));
                                                        $plan = $planQuery->fetch(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <td><?php echo ($plan['planned']); ?></td>
                                                    <?php endfor; ?>
                                                <?php endif; ?>
                                                <td><?php echo ($user['PaFirstname'] . " " . $user['PaLastname']); ?></td>
                                                <td><?php echo ($user['StPN']); ?></td>
                                                <td><?php echo ($user['PaPN']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </main>
                </div>
            </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>
</html>