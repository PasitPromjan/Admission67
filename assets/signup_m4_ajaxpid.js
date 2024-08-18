
/*$(document).ready(function() {
    $("#pid").on("input", function() {
        var pid = $(this).val();
        if(pid.length === 13) { // ตรวจสอบว่าความยาวของ pid เท่ากับ 13 หรือไม่
            $.ajax({
                url: 'signup_m1_ajax_check.php', // ไฟล์ PHP ที่ใช้ในการตรวจสอบ
                type: 'POST',
                data: { pid: pid },
                success: function(response) {
                    if(response === 'exists') {
                        $("#pid-error").text("มีการลงทะเบียน pid นี้แล้ว");
                    } else {
                        $("#pid-error").text("");
                    }
                }
            });
        } else {
            $("#pid-error").text(""); // ล้างข้อความเมื่อ pid ไม่เท่ากับ 13 ตัว
        }
    });
});*/

$(document).ready(function() {
    $("#pid").on("input", function() {
        var pid = $(this).val();
        if(pid.length === 13) {
        $.ajax({
            url: 'signup_m4_ajax_check.php',
            type: 'POST',
            data: { pid: pid },
            success: function(response) {
                if (response === 'exists') {
                    $("#pid-error").text("มีการลงทะเบียน PID นี้แล้ว").show();
                    $("#pid").addClass("is-invalid");
                } else {
                    $("#pid-error").text("").hide();
                    $("#pid").removeClass("is-invalid");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
    }
    });
});




let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file)
            }
        }