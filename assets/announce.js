var announce;
$(document).ready(() => {
    $.ajax({
        method: 'GET',
        url: 'announce.php',
        dataType: 'json', // เพิ่ม dataType เพื่อให้มั่นใจว่า response จะถูกแปลงเป็น JSON
        success: function(response) {
            console.log(response);
            if (response.RespCode == 200) {
                announce = response.Result;

                if (Array.isArray(announce)) {
                    var html = '';
                    for (let i = 0; i < announce.length; i++) {
                        html += `<li><a href="link/${announce[i].link}" target="_blank">${announce[i].description}</a></li>`;
                    }
                    $("#announce-list").html(html);
                } else {
                    console.error('Invalid Result format');
                }
            } else {
                console.error('Invalid RespCode');
            }
        },
        error: function(err) {
            console.error('AJAX error:', err);
        }
    });
});
