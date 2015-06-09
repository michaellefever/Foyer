$('#timeform').submit(function(event){
    event.preventDefault();
    var useridField = $('#userid');
    $.ajax({
        url: 'participations/time',
        type: "POST",
        data: {'userid':useridField.val(),'_token': $('input[name=_token]').val()},
        success: function(response){
            $('#arrivals'+response[0]).html(response[1]);
            if(response[2]){
            $('#tbody2').prepend(
                response[2]);
            }
            if(response[3]){
                var alertDiv = $('#alert');
                alertDiv.show();
                alertDiv.delay(2000).slideUp(500);
                alertDiv.html(response[3]);
            }
        }
    });
    useridField.val('');
});