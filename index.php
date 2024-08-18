<?php 
    session_start(); 
    require_once 'config/db.php';
    if (isset($_POST['go_signin']))
    {
        header("location: signin.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="icon" type="image/x-icon" href="icon.png">
    <title>ระบบรับสมัครนักเรียนเข้าศึกษาต่อระดับชั้นมัธยมศึกษาปีที่ 1และ 4</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Tangerine">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      body{
        font-family:Kanit, serif;
      }

      
    </style>
</head>
<body style="background: linear-gradient(125deg, #D32431, #910000);">
    <?php
        if(!isset($_SESSION['user_login'])){
            include 'navB.php';
        }
        else{
            include 'navUser.php';
        }
    ?>
    <?php 
    $stmt = $conn->query("SELECT * FROM exist WHERE id=1");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <br>
    
    <div class="container">
        
    <form action="index.php" method="POST">
        <div class="bg-light p-5 rounded" style="overflow: hidden; ">
            
            <center><h4 class="alert alert-warning">ระบบรับสมัครนักเรียนเข้าศึกษาต่อระดับชั้นมัธยมศึกษาปีที่ 1 และ 4 ปีการศึกษา 2567<br> ประเภทห้องเรียนปกติ</h4>
            <h4 class='text-danger'>เปิดรับสมัครตั้งแต่วันที่ 4 มีนาคม 2567 เวลา 8.30 น. ถึงวันที่ 13 มีนาคม 2567 เวลา 16.30น.</h4></center>
            <br>
            <hr>
            
                    <div class="card" >
                        <div class="card-header bg-danger text-light"><h5>ประกาศ</h5></div>
                        <div class="card-body announce" id="announce-list" style="max-height: 150px; overflow-y: auto;">


                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-3 text-center">
                            <div class="card">
                                <div class="card-body shadow-sm  g-0 border rounded overflow-hidden h-lg-250" >
                                    <v class="card-text"><span class="material-symbols-outlined" style="font-size:40px;">library_add</span><h5>มัธยมศึกษาปีที่ 1</h5></v>
                                    <p>   
                                        <div class="d-flex justify-content-center">
                                            <?php if($row['open'] == 1){ ?><a href="signupM1"  class="btn btn-outline-danger "><h5> สมัคร</h5></a> <?php } ?>
                                            <a href="1.pdf" target="_blank" class="btn btn-danger ms-1 d-flex justify-content-center align-items-center">วิธีการสมัคร</a>
                                        </div>
                                        
                                    </p>
                                    <a target="_blank" href="https://sites.google.com/kp.ac.th/2567/%E0%B8%8A%E0%B8%99%E0%B8%A1%E0%B8%98%E0%B8%A2%E0%B8%A1%E0%B8%A8%E0%B8%81%E0%B8%A9%E0%B8%B2%E0%B8%9B%E0%B8%97-1/%E0%B8%A1-1-%E0%B8%AB%E0%B8%AD%E0%B8%87%E0%B9%80%E0%B8%A3%E0%B8%A2%E0%B8%99%E0%B8%9E%E0%B9%80%E0%B8%A8%E0%B8%A9?authuser=0"  class="btn btn-outline-danger "><h5> รายละเอียดการรับสมัคร</h5></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mb-3 text-center">
                                <div class="card">
                                    <div class="card-body shadow-sm  g-0 border rounded overflow-hidden h-lg-250" >
                                        <v class="card-text"><span class="material-symbols-outlined" style="font-size:40px;">library_add</span><h5>มัธยมศึกษาปีที่ 4</h5></v>
                                            <p>
                                                
                                                <div class="d-flex justify-content-center">
                                                    <?php if($row['open'] == 1){ ?><a href="signup"  class="btn btn-outline-danger "><h5> สมัคร</h5></a> <?php } ?>
                                                    <a href="4.pdf" target="_blank" class="btn btn-danger ms-1 d-flex justify-content-center align-items-center">วิธีการสมัคร</a>
                                                 </div>
                                            </p>
                                            <a target="_blank" href="https://sites.google.com/kp.ac.th/2567/%E0%B8%8A%E0%B8%99%E0%B8%A1%E0%B8%98%E0%B8%A2%E0%B8%A1%E0%B8%A8%E0%B8%81%E0%B8%A9%E0%B8%B2%E0%B8%9B%E0%B8%97-4/%E0%B8%A1-4-%E0%B8%AB%E0%B8%AD%E0%B8%87%E0%B9%80%E0%B8%A3%E0%B8%A2%E0%B8%99%E0%B8%9E%E0%B9%80%E0%B8%A8%E0%B8%A9?authuser=0"  class="btn btn-outline-danger "><h5> รายละเอียดการรับสมัคร</h5></a>
                                    </div>
                                </div>
                        </div>
                    </div>
                    
                <div class="card border-danger">
                    
                    <div class="card-body">
                    <h4>เอกสารที่ต้องเตรียม</h4>
                    		<ol>
			<li>รูปถ่ายนักเรียนหน้าตรงแนวตั้ง (สามารถใช้โทรศัพท์มือถือถ่ายได้)</li>
                    	<li>เอกสารแสดงว่ากำลังศึกษาหรือจบการศึกษา ปพ.1  "ด้านหน้า"  หรือ ใบรับรองผลการเรียน ที่แสดงผลการเรียน (ปพ.7)</li>
                    	<li>เอกสารแสดงว่ากำลังศึกษาหรือจบการศึกษา ปพ.1  "ด้านหลัง"  หรือ ใบรับรองผลการเรียน ที่แสดงผลการเรียน (ปพ.7) ใบเดิมกับข้อ 2.</li>
                    	<li>สำเนาทะเบียนบ้าน พร้อมเซ็นสำเนาถูกต้อง  กำกับข้อความ "ใช้สำหรับสมัครเข้าศึกษาต่อโรงเรียนกำแพงเพชรพิทยาคม"</li>
                        </ol>
                    </div>
                </div>
                
                <hr>
                        <div class="card ">
                                <div class="chartBox">
                                    <h4 class="text-center">จำนวนนักเรียนที่สมัคร</h4>
                                    
                                    <?php 
                                    try {
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        
                                        // Fetch firstday and lastday from chartdate table where id = 1
                                        $stmt = $conn->prepare("SELECT firstday, lastday FROM chartdate WHERE id = 1");
                                        $stmt->execute();
                                        $dateRange = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $start_date = $dateRange['firstday'];
                                        $end_date = $dateRange['lastday'];

                                        function fetchCount($conn, $date, $table) {
                                            $stmt = $conn->prepare("SELECT COUNT(id) as count FROM $table WHERE DATE(sign_when) = :date");
                                            $stmt->execute(['date' => $date]);
                                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                            return $row['count'];
                                        }

                                        $dates = [];
                                        $currentDate = $start_date;
                                        while (strtotime($currentDate) <= strtotime($end_date)) {
                                            $dates[] = $currentDate;
                                            $currentDate = date("Y-m-d", strtotime($currentDate . ' + 1 day'));
                                        }

                                        $k = array_map(function($date) use ($conn) {
                                            return fetchCount($conn, $date, 'm1');
                                        }, $dates);

                                        $p = array_map(function($date) use ($conn) {
                                            return fetchCount($conn, $date, 'm4');
                                        }, $dates);

                                    } catch(PDOException $e) {
                                        die("ERROR: " . $e->getMessage());
                                    }
                                    ?>

                                    <canvas id="myChart" width="400" height="200"></canvas>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', (event) => {
                                            const m1Counts = <?php echo json_encode($k); ?>;
                                            const m4Counts = <?php echo json_encode($p); ?>;
                                            const labels = <?php echo json_encode(array_map(function($date) {
                                                return 'วันที่ ' . date("j", strtotime($date));
                                            }, $dates)); ?>;
                                            
                                            const data = {
                                                labels: labels,
                                                datasets: [
                                                    {
                                                        label: 'ชั้นมัธยมศึกษาปีที่ 1',
                                                        backgroundColor: '#FFE382',
                                                        borderColor: '#FFC47E',
                                                        borderWidth: 1,
                                                        data: m1Counts,
                                                    },
                                                    {
                                                        label: 'ชั้นมัธยมศึกษาปีที่ 4',
                                                        backgroundColor: '#FF6969',
                                                        borderColor: '#C70039',
                                                        borderWidth: 1,
                                                        data: m4Counts,
                                                    }
                                                ]
                                            };

                                            const config = {
                                                type: 'bar',
                                                data: data,
                                                options: {
                                                    responsive: true,
                                                    plugins: {
                                                        legend: {
                                                            position: 'top',
                                                        },
                                                        title: {
                                                            display: true,
                                                            text: 'จำนวนนักเรียนที่สมัครแต่ละวัน'
                                                        }
                                                    },
                                                    scales: {
                                                        y: {
                                                            beginAtZero: true,
                                                            title: {
                                                                display: true,
                                                                text: 'จำนวน'
                                                            }
                                                        },
                                                        x: {
                                                            title: {
                                                                display: true,
                                                                text: 'วัน'
                                                            }
                                                        }
                                                    }
                                                },
                                            };

                                            const ctx = document.getElementById('myChart').getContext('2d');
                                            new Chart(ctx, config);
                                        });
                                    </script>
                                </div>
                        </div>
            <!--<div class="container">
                    <?php


                        $stmt = $conn->query("SELECT * FROM m4 WHERE stat IN (3)");
                        $stmt->execute();

                        
                    ?>
                    <h3 class="text-center mt-3"> ห้องสอบและเลขที่นั่งสอบ</h3>
                    <form action=" search.php" class="form-group my-3" method="POST">
                    <div class="row">
                        <div class="col-6">
                        <input type="text" placeholder="กรอกเลขประจำตัวนักเรียน" class="form-control" name="data" required>
                        </div>
                        <div class="col-6">
                        <input type="submit" value="ค้นหา" class="btn btn-outline-danger me-2">
                        
                        </div>
                    </div>
                    <br>
                <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                    <th>เลขที่นั่งสอบ</th>
                    <th>ห้องสอบ</th>                    
                    <th>เลขที่สมัคร</th>
                    <th>ชื่อ-สกุล</th>

                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $row["test_id"]; ?></td>
                        <td><?php echo ("not yet"); ?></td>                        
                        <td><?php echo $row["firstname"]; ?></td>
                        <td><?php echo $row["lastname"]; ?></td>

                    </tr>
                    <?php } ?>
                </tbody>
                </table>
            </div>
        </div>-->
    </form>
            
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="assets/announce.js"></script>
    
</body>
</html>