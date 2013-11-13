$(document).ready(function() {
    //sortable tables
    $('.sortable').dataTable({
        "bPaginate": false,
        "sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>"
    });
    
    //select all action
    $(".glyphicon-check").parent().click(function (){
        $('input[type="checkbox"]').prop('checked', true);
    });
});

