$(document).ready(() => {
    // Load data from API
    $.ajax({
        url: 'announce.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var html = '';
            for (let i = 0; i < data.length; i++) {
                html += `<tr>
                            <td>${data[i].id}</td>
                            <td><a href="${data[i].link}" target="_blank">${data[i].link}</a></td>
                            <td>${data[i].description}</td>
                        </tr>`;
            }
            $("#announce-table tbody").html(html);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching data: ', textStatus, errorThrown);
        }
    });

    
    $('#add-form').on('submit', function(e) {
        e.preventDefault();
        const link = $('#link').val();
        const description = $('#description').val();

        
        $.ajax({
            url: 'announce.php',
            method: 'POST',
            data: {
                link: link,
                description: description
            },
            success: function(response) {
                
                $('#addModal').modal('hide');
                
                $.ajax({
                    url: 'announce.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        for (let i = 0; i < data.length; i++) {
                            html += `<tr>
                                        <td>${data[i].id}</td>
                                        <td><a href="${data[i].link}" target="_blank">${data[i].link}</a></td>
                                        <td>${data[i].description}</td>
                                    </tr>`;
                        }
                        $("#announce-table tbody").html(html);
                    }
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error adding data: ', textStatus, errorThrown);
            }
        });
    });
});