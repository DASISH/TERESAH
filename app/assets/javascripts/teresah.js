/*
TERESAH JavaScript
---------------------------------------------------------------------------- */

$(document).ready(function() {
    // Initialize the jQuery Autosize
    $("textarea").autosize();

    // Initialize the X-editable
    $.fn.editable.defaults.mode = "inline";
    $(".editable").editable({
        ajaxOptions: {
            type: "PUT"
        }
    });
});
