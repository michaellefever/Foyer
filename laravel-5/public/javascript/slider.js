var sliderDiv = $("#slider");
sliderDiv.slider({
    animate: "fast",
    min:3,
    max:100,
    values: [ 3, 100 ],
    range: true
});
$('#min').html(sliderDiv.slider( "option", "values" )[0]);
$('#max').html(sliderDiv.slider( "option", "values" )[1]);
sliderDiv.on( "slide", function( event, ui ){
    $('#min').html(ui.values[0]);
    $('#max').html(ui.values[1]);
});