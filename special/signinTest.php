<?php 
    session_start();
    require_once 'config/db.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <img src="logo.png" alt=" School Logo" class="brand-image" style="opacity: .8" height="30">
    <title>ระบบรับสมัครนักเรียนเข้าศึกษาต่อระดับชั้นมัธยมศึกษาปีที่ 1และ 4</title>
    <style type="text/css"> 

    #printable { display: block; }

    @media print 
    { 
        #non-printable { display: none; } 
        #printable { display: block; } 
    } 

    </style> 
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: #910000;">
<div id="non-printable"> 
    <?php include 'nav.php';?>
    <br>
</div>    
    <div class="container">
        <div class="bg-light p-5 rounded">
            <div id="non-printable">
                <h3 class="mt-4">พิมพ์บัตรประจำตัวสอบ</h3>
                <hr>
                <form action="signinTest_db.php" method="post" class="needs-validation" novalidate>
                    <?php if(isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php 
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            ?>
                        </div>
                    <?php } ?>
                    <?php if(isset($_SESSION['success'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?php 
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                            ?>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="pid" class="form-label">เลขบัตรประชาชน / เลขบัตรคนต่างด้าว</label>
                            <input type="pid" class="form-control" name="pid" required>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล 
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="date" class="form-label">วันเกิด (วว/ดด/ปปปป เช่น 22/03/2550)</label>     
                            <input type="text" class="form-control" name="date" pattern="\d{2}/\d{2}/\d{4}" required>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล และกรอกรูปแบบให้ถูกต้อง 
                            </div>
                        </div>        
                        <div class="col-md-2">
                            <label for="class" class="form-label">ชั้น </label>
                            <select  name="class" class="form-control" required>
                                <option value=""></option>
                                <option value="1">ม.1</option>
                                <option value="4">ม.4</option>
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกข้อมูล 
                            </div>
                        </div>
                        <div class="col-md-3">
                            <br>
                        <button type="submit" name="signin" class="btn btn-outline-primary">พิมพ์</button>
                        </div>           
                    </div>
                    
                </form>
            </div>
            
        
        </div>
    </div>
    
    <script src="assets/url.js"></script>
    <script src="assets/jquery.min.js"></script>
    <script src="assets/script.js"></script>
    <script src="assets/tes.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
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
    
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>
</html>