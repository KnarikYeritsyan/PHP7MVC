$(function () {
    $.get('dashboard/xhrGetListings',function (o) {
        //console.log(o[0].text);
        for (var i=0; i<o.length;i++)
        {
            $('#listInserts').append('<div>' + o[i].text + '</div>');
        }

    },'json');
    $('#listInserts');
    $('#randomInsert').submit(function () {
        var url = $(this).attr('action');
        var data = $(this).serialize();
        $.post(url,data,function (o) {
            $('#listInserts').append('<div>' + o + '</div>');
        });
        //console.log(data);

        return false;
    });
});

