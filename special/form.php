<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo v5.3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<style type="text/css"> 

#printable { display: block; }

@media print 
{ 
     #non-printable { display: none; } 
     #printable { display: block; } 
} 

</style> 

<script>
    Swal.fire({
        title: 'Devdit',
        text: 'กล่องข้อความสวยๆ ด้วย sweetalert2',
        icon: 'success',
        confirmButtonText: 'สุดยอดเลย'
    });
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
<!--

<!-- Modal เพิ่มข้อมูลนักศึกษา 

    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="reset" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font color="#FFFFFF">&times;</font></span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-plus"></span> เพิ่มข้อมูลนักศึกษา</h4>
      </div>
      <div class="modal-body">
      
      <form name="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>รหัสนิสิต:</label>
            <input type="text" name="" class="form-control" required="">
          </div>
           <div class="form-group">
            <label>ชื่อนิสิต:</label>
            <input type="text" name="" class="form-control" required="">
          </div>
           <div class="form-group">
            <label>รหัสผ่านนิสิต :</label>
            <input type="text" name="" class="form-control" required="">
          </div>
           <div class="form-group">
            <label>อีเมล์ :</label>
            <input type="email" name="" class="form-control" required="">
          </div>
           <div class="form-group">
            <label>เบอร์โทรศัพท์ :</label>
            <input type="text" name="" class="form-control" required="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="btnAddStudent" id="btnAddStudent" class="btn btn bg-green btn-sm">บันทึกข้อมูล</button>
        <button type="button" class="btn btn bg-red btn-sm" data-dismiss="modal">ปิดหน้าต่างนี้</button>
      </div>
      </form>
    </div>  -->


<?php	
	//ลบ Student			
	if(isset($_POST['btnAddStudent'])){
			
	
			//$sqld_delete = "DELETE FROM table_student WHERE Student_ID = '$Student_ID'";
		//	$queryd_delete = mysqli_query($connection, $sqld_delete);
			//if($queryd_delete)
			{
				echo '123';
				echo '
		<script>			
				Swal.fire({
    type: "error",
    title: "Oops...",
	icon: "success",
    confirmButtonText: "Shopping",
    text: "There is no items on your cart.",
  
    showCloseButton: true
})
.then(function (result) {
    if (result.value) {
        window.location = "..";
    }
})
</script>
';
			}
			
	
	}
?>



<div id="non-printable"> 
     <center><font color="red"><b>สิ่งที่จะให้แสดงออกมาทางหน้าจอ แต่ว่าไม่เห็นเวลา Print หน้านี้ออกมา</b></font></center>
<input type='button' value='พิมพ์ข้อมูล' onclick='print()'>
</div> 
<div id="printable"> 
    <div class="container mt-5">
        <h4>Bootstap5 Form Validation</h4>
        <hr>  <br> 
        <form method="post" action="form.php" class="row g-3 needs-validation" novalidate>
            
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">ชื่อ</label>
                    <input name="nnn" type="text" class="form-control" id="validationCustom01" required minlength="3" placeholder="ชื่อ">
                    <div class="invalid-feedback">
                        ห้ามว่าง และขั้นต่ำ 3 ตัวอักษร
                    </div>
                </div>
           

           
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">นามสกุล</label>
                    <input type="text" class="form-control" id="validationCustom02" required minlength="3" placeholder="นามสกุล">
                    <div class="invalid-feedback">
                        ห้ามว่าง และขั้นต่ำ 3 ตัวอักษร
                    </div>
                </div>
           

          
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label">เบอร์โทร 10 หลัก</label>
                    <input type="text" class="form-control" id="validationCustom03" required minlength="10" maxlength="10"
                        placeholder="เบอร์โทร" pattern="[0-9]*">
                    <div class="invalid-feedback">
                        กรอกเบอร์โทร 10 หลัก
                    </div>
                </div>
           
				<div class="col-md-6">
                    <label for="validationCustom04" class="form-label">วันเกิด</label>
                    <input type="text" class="form-control" name="dateInput" pattern="\d{2}/\d{2}/\d{4}" title="Enter a date in the format YYYY-MM-DD" required>
                    <div class="invalid-feedback">
                        ห้ามว่าง และกรอกรูปแบบอีเมลให้ถูกต้อง 
                    </div>
                </div>
           
                <div class="col-md-6">
                    <label for="validationCustom05" class="form-label">Email</label>
                    <input type="email" class="form-control" id="validationCustom05" required  placeholder="Email">
                    <div class="invalid-feedback">
                        ห้ามว่าง และกรอกรูปแบบอีเมลให้ถูกต้อง 
                    </div>
                </div>

            <div class="col-12">
                <button name="btnAddStudent" id="btnAddStudent" class="btn btn-primary" type="submit">Submit form</button>
            </div>
        </form>
    </div>
</div> 
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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
    integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
    crossorigin="anonymous"></script>