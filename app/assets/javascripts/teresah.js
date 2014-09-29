/*
 TERESAH JavaScript
 ---------------------------------------------------------------------------- */

// Mimics the rails.js's handleMethod() function
function handleMethod(link) {
    var href = link.attr("href");
    var method = link.data("method");
    var form = $("<form action=\"" + href + "\" method=\"POST\"></form>");
    var metaDataInput = "<input type=\"hidden\" name=\"_method\" value=\"" + method + "\">";

    form.hide().append(metaDataInput).appendTo("body");
    form.submit();
}

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

    // Add an event handler to listen DELETE through link requests
    $("a[data-method=\"delete\"]").on("click", function(event) {
        var link = $(this);
        var message = link.data("confirm");

        event.preventDefault();

        if (!message || confirm(message)) {
            handleMethod(link);
        }
    });

    //set up quicksearch
    var tools = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: '/tools/quicksearch/%QUERY'
    });
    tools.initialize();
    
    var data = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: '/data/quicksearch/%QUERY'
    });
    data.initialize();
    

    $('#quicksearch').typeahead({
            highlight: true
        },
        {
            name: 'Tools',
            displayKey: 'name',
            source: tools.ttAdapter(),
            templates: {
                empty: [
                    '<div class="empty-message">',
                    '',
                    '</div>'
                ].join('\n'),
                suggestion: function(data) {
                    return '<p><a href="' + data.url + '"><span class="glyphicon glyphicon-wrench" /><strong>' + data.name + '</strong></a></p>';
                }
            }
        },
        {
            name: 'Facet',
            displayKey: 'name',
            source: data.ttAdapter(),
            templates: {
                empty: [
                    '<div class="empty-message">',
                    'no results found',
                    '</div>'
                ].join('\n'),
                suggestion: function(data) {
                    return '<p><a href="' + data.url + '"><span class="glyphicon glyphicon-tag" /><strong>' + data.name + '</strong></a></p>';
                }
            }
        }        
        ).on('typeahead:selected', function (obj, datum) {
            window.location.href = datum.url;
        });
});
