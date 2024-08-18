$(document).ready(function() {
    $('#submitBtn').click(function(e) {
        e.preventDefault();

        let pid = $('#pid').val();
        let date = $('#date').val();
        let class_ = $('#class').val();

        $.ajax({
            url: 'signin_db.php',
            type: 'POST',
            data: {
                pid: pid,
                date: date,
                class: class_,
                signin: true
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.location.href = response.redirect;
                } else {
                    $('#result').html('<div class="alert alert-danger" role="alert">' + response.error + '</div>');
                }
            },
            error: function() {
                $('#result').html('<div class="alert alert-danger" role="alert">เกิดข้อผิดพลาดในการติดต่อเซิร์ฟเวอร์</div>');
            }
        });
    });
    
    // Submit form when the fields change
    $('#pid, #date, #class').on('change', function() {
        $('#submitBtn').click();
    });
});