$(document).ready(function() {
    //sortable tables
    $('.sortable').dataTable({
        "bPaginate": false,
        "sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>"
    });
    
    //select or deselect all action
    $(".glyphicon-check").parent().click(function (){
        if($('input[type="checkbox"]').is(':checked')){
            $('input[type="checkbox"]').prop('checked', false);
        }else{
            $('input[type="checkbox"]').prop('checked', true);
        }
        
    });    
});

