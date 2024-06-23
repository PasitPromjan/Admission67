<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])&&!isset($_SESSION['staff_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin.php');
    }
?>
<?php
    if(isset($_POST['Editadmin']))
    {
        $password = $_POST['password'];
        $username = $_POST['username'];
        $admin_id = $_SESSION['admin_login'];

        $sql = $conn->prepare("UPDATE admins SET password=:password,username=:username WHERE id = :admin_id");
        $sql->bindParam(":password", $password);
        $sql->bindParam(":username", $username);
        $sql->bindParam(":admin_id", $admin_id);
        $sql->execute();
    }

?>

<?php
    if(isset($_POST['openSign']))
    {
        $open = 1;
        $admin_id = $_SESSION['admin_login'];

        $sql = $conn ->prepare("UPDATE exist SET open=:open WHERE id=1");
        $sql->bindParam(":open", $open);
        $sql->execute();
    }

    if(isset($_POST['closeSign']))
    {
        $open = 0;
        $admin_id = $_SESSION['admin_login'];

        $sql = $conn ->prepare("UPDATE exist SET open=:open WHERE id=1");
        $sql->bindParam(":open", $open);
        $sql->execute();
    }

    if(isset($_POST['openEdit']))
    {
        $edits = 1;
        $admin_id = $_SESSION['admin_login'];

        $sql = $conn->prepare("UPDATE exist SET edits=:edits WHERE id=1");
        $sql->bindParam(":edits", $edits);
        $sql->execute();
    }

    if(isset($_POST['closeEdit']))
    {
        $edits = 0;
        $admin_id = $_SESSION['admin_login'];

        $sql = $conn->prepare("UPDATE exist SET edits=:edits WHERE id=1");
        $sql->bindParam(":edits", $edits);
        $sql->execute();
    }

    if(isset($_POST['openPrint']))
    {
        $prints = 1;
        $admin_id = $_SESSION['admin_login'];

        $sql = $conn->prepare("UPDATE exist SET prints=:prints WHERE id=1");
        $sql->bindParam(":prints", $prints);
        $sql->execute();
    }

    if(isset($_POST['closePrint']))
    {
        $prints = 0;
        $admin_id = $_SESSION['admin_login'];

        $sql = $conn->prepare("UPDATE exist SET prints=:prints WHERE id=1");
        $sql->bindParam(":prints", $prints);
        $sql->execute();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="theme-color" content="#7952b3">
</head>
<body class="bg-dark">
  <?php include 'adminHEADBAR.php';?>
  
  <div class="container-fluid">
    <div class="bg-light p-5 rounded"> 
    

        <main >
                <?php 

                    if (isset($_SESSION['admin_login'])) {
                        $admin_id = $_SESSION['admin_login'];
                        $stmt = $conn->query("SELECT * FROM admins WHERE id = $admin_id");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                ?>
                <?php 

                    if (isset($_SESSION['staff_login'])) {
                        $staff_id = $_SESSION['staff_login'];
                        $stmt = $conn->query("SELECT * FROM admins WHERE id = $staff_id");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
            <div class="container">
                <form action="admin67.php" method="post">
                    <h5 class='text-success'>รหัสของ <?php if (isset($_SESSION['admin_login'])) {echo "admin";} else { echo "staff";} ?></h5>
                    <div class="mb-3">
                        <div class='row'>
                            <div class='col-md-2'>
                                <div class='form-group'>
                                    <label for="username" class="form-label">รหัส :</label>
                                    <input type="text" value="<?php echo $row['username']; ?>" required class="form-control" name="username">
                                </div>
                            </div>

                            <div class='col-md-2'>
                                <div class='form-group'>
                                    <label for="password" class="form-label">รหัส :</label>
                                    <input type="text" value="<?php echo $row['password']; ?>" required class="form-control" name="password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-2'>
                        <button type="submit" name="Editadmin" class="btn btn-primary">แก้ไข</button>
                    </div>
                </form>
                <br>
                <hr>

                <?php if (isset($_SESSION['admin_login'])) { ?>
                <form action="admin67.php" method="post">
                    <?php


                    $stmt = $conn->query("SELECT * FROM exist WHERE id=1");
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);


                    ?>
                    <div class="mb-3">
                        <div class='row'>
                            <h5 class='text-success'>สถานะลงทะเบียน : <?php if($row['open']==1){echo "เปิด";} else{echo "ปิด";} ?> </h5>
                            <div class='col-md-1'>
                                <button type="submit" name="openSign" class="btn btn-success">open</button>
                            </div>
                            <div class='col-md-1'>
                                <button type="submit" name="closeSign" class="btn btn-danger">close</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="mb-3">
                        <div class='row'>
                            <h5 class='text-success'>สถานะแก้ไข : <?php if($row['edits']==1){echo "เปิด";} else{echo "ปิด";} ?> </h5>
                            <div class='col-md-1'>
                                <button type="submit" name="openEdit" class="btn btn-success">open</button>
                            </div>
                            <div class='col-md-1'>
                                <button type="submit" name="closeEdit" class="btn btn-danger">close</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="mb-3">
                        <div class='row'>
                            <h5 class='text-success'>สถานะพิมพ์ใบสอบ : <?php if($row['prints']==1){echo "เปิด";} else{echo "ปิด";} ?> </h5>
                            <div class='col-md-1'>
                                <button type="submit" name="openPrint" class="btn btn-success">open</button>
                            </div>
                            <div class='col-md-1'>
                                <button type="submit" name="closePrint" class="btn btn-danger">close</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php } ?>
          </main>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <script src="assets/jquery.min.js"></script>
    <script src="assets/script.js"></script>
    <script src="assets/tes.js"></script>
    
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