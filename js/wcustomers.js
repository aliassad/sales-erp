
$(document).ready(function () {

    var url = 'views/gettingWcustomers.php';
    $.getJSON(url, function (data) {
        $('#loading').hide();
        var i=0;
        $.each(data, function (index, data) {
            i++;
            $('#customers').append('<tr  id="'+ data.id +'" ><td>' + i + '</td><td>' + data.name + '</td><td>' + data.phone + '</td></tr>');
        });

    });
});


