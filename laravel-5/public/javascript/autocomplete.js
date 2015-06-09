/**
 * Created by Bram on 20/05/2015.
 */
$(function () {
    $("#firstName").autocomplete({
        source: "search/autocomplete",
        minLength: 2,
        select: function (event, ui) {
            //$('#firstName').val(ui.item.value);
            var id = ui.item.id;
            window.location =  id + '/edit';
        }
    });
});