<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])&&!isset($_SESSION['staff_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin.php');
    }

?>

<?php

    if(isset($_POST['update']))
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $stid = $_POST['stid'];
        $pid = $_POST['pid'];
        $id = $_POST['id'];


        $user_id = $_SESSION['user_login'];
        $sql = $conn->prepare("UPDATE users SET   firstname = :firstname, lastname = :lastname,stid =:stid,pid = :pid WHERE id = :id");
        $sql->bindParam(":firstname", $firstname);
        $sql->bindParam(":lastname", $lastname);
        $sql->bindParam(":stid", $stid);
        $sql->bindParam(":pid", $pid);
        $sql->bindParam(":id", $id);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php include 'adminHEADBAR.php';?>
  
  <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php include 'adminSIDEBAR.php';?> 

            <main class="col py-3">
                <div class="container">
                    <?php 

                            if (isset($_GET["id"])) {
                                $id = $_GET["id"];
                                $stmt = $conn->query("SELECT * FROM users WHERE id = $id");
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            }
                    ?>
                    <form action="adminStaffEdit_db.php" method="post">
                        <h3 class="mt-4"> </h3>
                    
                            <?php if(isset($_SESSION['status'])) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?php 
                                        echo $_SESSION['status'];
                                        unset($_SESSION['status']);
                                    ?>
                                </div>
                            <?php } ?>
                        
                        <div class="mb-3">
                            <div class='row'>
                            <div class='form-group'>
                                <input type="hidden" readonly value="<?php echo $row['id']; ?>" required class="form-control" name="id" >
                                <label for="firstname" class="col-form-label">ชื่อ</label>
                                <input type="text" value="<?php echo $row['firstname']; ?>" required class="form-control" name="firstname" >
                                </div>
                                <div class='form-group'>
                                <label for="lastname" class="col-form-label">สกุล</label>
                                <input type="text" value="<?php echo $row['lastname']; ?>" required class="form-control" name="lastname" >
                                </div>
                                <div class='form-group'>
                                <label for="pid" class="col-form-label">เลขบัตรประชาชน</label>
                                <input type="text" value="<?php echo $row['pid']; ?>" required class="form-control" name="pid" >
                                </div>
                                <div class='form-group'>
                                <label for="stid" class="col-form-label">เลขประจำตัวนักเรียน</label>
                                <input type="text" value="<?php echo $row['stid']; ?>" required class="form-control" name="stid" >
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>
</html>