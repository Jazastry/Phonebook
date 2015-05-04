$(document).ready(function() {
    $('#addCustom').click(function(){        
        var elementCount = $('.customField').length;
        var last = 'input';
        if (elementCount > 0) {
            last = '.customField';
        }
        $('#phonesCreateForm '+last+':last').after(
            '<link rel="stylesheet" href="/content/css/styleS.css"/>' +
            '<div class="customField">' +
                '<div>'+ 
                    '<label for="field_name">Field name</label>'+
                    '<input type="text" name="field_name'+elementCount+'"/>'+
                '</div>' +
                '<div>' +
                    '<label for="field_value">Field value</label>' +
                    '<input type="text" name="field_value'+elementCount+'"/>' +
                '</div>' +
            '</div>'
        );
    });
    $('#removeCustom').click(function(){
        var elementCount = $('.customField').length;
        if (elementCount > 0) {
            $('#phonesCreateForm .customField:last').remove();
        }
    });
});

