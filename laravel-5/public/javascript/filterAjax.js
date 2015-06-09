/**
 * Created by Bram on 20/05/2015.
 */

$('#searchform').submit(function(event){
    event.preventDefault();
    ajaxFilter();
});

$('#search').click(function(){
    ajaxFilter();
});

$('.filter').change(function(){
    var years = $('input[name=year]:checked').map(function(){
    return this.value;
    }).get();
    var distances = $('input[name=distance]:checked').map(function(){
        return this.value;
    }).get();
    var sex = $('input[name=sex]:checked').map(function(){
        return this.value;
    }).get();
    var ageMin = $('#min').html();
    var ageMax = $('#max').html();
    var id = null;
    var pathname = $(location).attr('pathname');
    if(pathname.indexOf("race") > -1){
        id = $(location).attr('pathname').split("/")[4];
    }
    if($('#filterinput').val() != ''){
        ajaxFilter();
    }else{
        $.ajax({
            url: 'participations/filter',
            type: "POST",
            data: {'years':years,'distances':distances,'sex':sex,'id':id,
                'ageMin':ageMin,'ageMax':ageMax,'_token': $('input[name=_token]').val()},
            success: function(response){
                $('#table').html(response);
                $("#myTable").tablesorter({
                    dateFormat : "uk" // default date format
                });
            }
        });
    }
});

function ajaxFilter(){
    var years = $('input[name=year]:checked').map(function(){
        return this.value;
    }).get();
    var distances = $('input[name=distance]:checked').map(function(){
        return this.value;
    }).get();
    var sex = $('input[name=sex]:checked').map(function(){
        return this.value;
    }).get();
    var ageMin = $('#min').html();
    var ageMax = $('#max').html();
    var id = null;
    var pathname = $(location).attr('pathname');
    if(pathname.indexOf("race") > -1){
        id = $(location).attr('pathname').split("/")[4];
    }
    $.ajax({
        url: "participations/filter",
        type: "POST",
        data: {'filteropt':$('#filteropt').val(),'queryString':$('#filterinput').val(),'years':years,'distances':distances,
            'sex':sex,'id':id,'ageMin':ageMin,'ageMax':ageMax,'_token': $('input[name=_token]').val()},
        success: function(response){
            $('#table').html(response);
            $("#myTable").tablesorter({
                dateFormat : "uk" // default date format
            });
        }
    });
}