/**
 * Created by Bram on 20/05/2015.
 */
$(function() {
    $( "#datepicker" ).datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true,
        maxDate: "-2Y",
        minDate: "-100Y",
        yearRange: "-100:-2"
    });
});