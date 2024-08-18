<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navB.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
<?php 
  $stmt = $conn->query("SELECT * FROM exist WHERE id=1");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<br><br><br>
<nav class="navbar navbar-expand-lg fixed-top ">
        <div class="container ">
            <img src="logo-Photoroom.png" alt=" School Logo" class="brand-image" style="opacity: .8" height="40">
            <a class="navbar-brand me-auto d-none d-lg-block"  >ระบบรับสมัครนักเรียนโรงเรียนกำแพงเพชรพิทยาคม</a>
            <div class="navbar-brand me-auto d-lg-none">โรงเรียนกำแพงเพชรพิทยาคม</div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <img src="logo-Photoroom.png" alt=" School Logo" class="brand-image" style="opacity: .8" height="40">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2"  href="index.php">หน้าหลัก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="signin">ตรวจสอบการสมัคร</a>
                        </li>
                        <?php if($row['edits']==1){ ?>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="signinEdit">แก้ไขข้อมูลการสมัคร</a>
                        </li>
                        <?php } ?>
                        <?php if($row['prints']==1){ ?>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="signinTest">พิมพ์บัตรประจำตัวสอบ</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            
            <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>