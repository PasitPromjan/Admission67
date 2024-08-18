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
        header("refresh:1; url=adminMboard.php?$query");
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
    
    <meta name="theme-color" content="#7952b3"><link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Tangerine">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="bg-dark">
  <?php include 'adminHEADBAR.php';?>
  
    <div class="container-fluid">
        <div class="bg-light p-5 rounded">
        
            <?php
                $order = 1;
                $class = isset($_GET['class']) ? $_GET['class'] : null;
                $stat = isset($_GET['stat']) ? $_GET['stat'] : null;
            ?>
            <main class="col py-3">
                <h1 class="text-center mt-3"><?php switch($stat){    case 0:echo"รายชื่อนักเรียนสมัคร รอการตรวจสอบ";break;
                                                                    case 1:echo"รายชื่อนักเรียนที่ไม่ผ่านการตรวจสอบ";break;
                                                                    case 2:echo"รายชื่อนักเรียนที่ผ่านการตรวจสอบ";break;
                                                                    case 3:echo"รายชื่อนักเรียน ที่พร้อมตั้งเลขที่นั่งสอบ";break;
                                                                    default:echo"ERROR";break; }?></h1>
                <form action="adminMboardSearched.php?class=<?php echo $class; ?>&stat=<?php echo $stat; ?>" class="form-group my-3" method="POST">
                    <div class="row">
                        <div class="col-6">
                            <input type="text" placeholder="กรอกชื่อนักเรียน" class="form-control" name="data" required>
                        </div>
                        <div class="col-6">
                            <input type="submit" value="ค้นหา" class="btn btn-info">
                        </div>
                    </div>
                </form>

                <!-- เพิ่มการห่อหุ้มตารางด้วย div ที่มี class="table-responsive" -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>คำนำหน้าชื่อ-สกุล</th>
                                <th>โรงเรียน</th>
                                <th>เลขบัตรประชาชน</th>
                                <th>จังหวัด</th>
                                <th>อำเภอ</th>
                                <?Php if($stat==2){ ?>
                                    <th>แผนการเรียน</th>
                                <?Php } ?>
                                <th>เบอร์นักเรียน</th>
                                <th>เบอร์ผู้ปกครอง</th>
                                <th>เวลาแก้ไข</th>
                                <th> </th>
                                <th>ตรวจโดย</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($class && $stat !== null) {
                                if ($class == "4") {
                                    $stmt = $conn->prepare("SELECT * FROM m4 WHERE (stat=? and urole='user') ORDER BY id");
                                } else if ($class == "1") {
                                    $stmt = $conn->prepare("SELECT * FROM m1 WHERE (stat=? and urole='user') ORDER BY id");
                                }
                                $stmt->execute([$stat]);
                                $users = $stmt->fetchAll();

                                if (!$users) {
                                    echo "<tr><td colspan='11' class='text-center'>No data available</td></tr>";
                                } else {
                                    foreach ($users as $user) {
                            ?>

                            <!---แผนการเรียน--->
                            <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class='text-success'>แผนการเรียน</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php 
                                            include("config/db.php");

                                            function displayPlans($class, $user, $conn) {
                                                $table = $class == "1" ? "plan1" : "plan4";
                                                $limit = $class == "1" ? 3 : 12;

                                                $p = $conn->query("SELECT * FROM $table");
                                                $plans = $p->fetchAll(PDO::FETCH_ASSOC);

                                                for ($i = 1; $i <= $limit; $i++) {
                                                    echo "<div class='form-group'>";
                                                    echo "<label for='p$i' class='col-form-label text-secondary'>แผนการเรียนอันดับที่ $i</label>";
                                                    foreach ($plans as $plann) {
                                                        if ($plann['id'] == $user["p$i"]) {
                                                            echo "<h5>{$plann['planned']}</h5>";
                                                        }
                                                    }
                                                    echo "<hr class='new'></div>";
                                                }
                                            }

                                            if ($class == "1" || $class == "4") { 
                                                echo "<div class='row'><div class='col-md-7'>";
                                                displayPlans($class, $user, $conn);
                                                echo "</div></div>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <tr>
                                <td><?php echo $order++; ?></td>
                                <td><?php echo $user['title'] . $user['firstname'] . " " . $user['lastname']; ?></td>
                                <td><?php echo $user['oldschool']; ?></td>
                                <td><?php echo $user['pid']; ?></td>
                                <?php
                                $prov = $conn->query("SELECT * FROM provinces ");
                                while ($result = $prov->fetch(PDO::FETCH_ASSOC)) {
                                    if ($result['id'] == $user['AD_Province']) {
                                ?>
                                <td><?php echo $result['name_th']; ?> </td>    
                                <?php } } ?>
                                <?php
                                $prov = $conn->query("SELECT * FROM amphures ");
                                while ($result = $prov->fetch(PDO::FETCH_ASSOC)) {
                                    if ($result['id'] == $user['AD_Subdistrict']) {
                                ?>
                                <td><?php echo $result['name_th']; ?> </td>    
                                <?php } } ?>
                                
                                <?php if($stat==2){ ?>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" data-bs-whatever="@mdo">ดูข้อมูล</button>
                                </td>
                                <?php }?>

                                <td><?php echo $user['StPN']; ?></td>
                                <td><?php echo $user['PaPN']; ?></td>
                                <?php 
                                $idd = $user['id'];
                                if ($class == '4') {
                                    $prov = $conn->query("SELECT DAY(edit_when) as day , MONTH(edit_when) as month , YEAR(edit_when) as year, HOUR(edit_when) as hour,MINUTE(edit_when) as minute , SECOND(edit_when) as second FROM m4 WHERE id=$idd; ");
                                    $roww = $prov->fetch(PDO::FETCH_ASSOC);
                                }
                                if ($class == '1') {
                                    $prov = $conn->query("SELECT DAY(edit_when) as day , MONTH(edit_when) as month , YEAR(edit_when) as year, HOUR(edit_when) as hour,MINUTE(edit_when) as minute , SECOND(edit_when) as second FROM m1 WHERE id=$idd; ");
                                    $roww = $prov->fetch(PDO::FETCH_ASSOC);
                                }
                                ?>
                                <td><?php echo $roww['day'] . "/" . $roww['month'] . "/" . $roww['year'] . " " . $roww['hour'] . ":" . $roww['minute'] . ":" . $roww['second']; ?> </td>  
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
                                <?php if (isset($_SESSION['admin_login'])) { ?>
                                <a onclick="return confirm('ต้องการจะลบข้อมูลใช่หรือไม่');" href="?delete=<?php echo $user['id']; ?>&class=<?php echo $class; ?>" class="btn btn-danger">ลบข้อมูล</a>
                                <?php } ?>
                                </td>
                                <td><?php echo $user['checkby']; ?></td>
                            </tr>
                            <?php } } } ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>
</html>