// Bind events for settings page
function bindPageEvents(){

    // Make all settings options inline editable
    $('table#card-types td.editable, table#status-names td.editable').editable('common/ajax_settings.php', {
         indicator  : 'Saving...',
         submitdata : {action: "saveSettings"},
         cssclass   : 'editing'
     });

     // Setup options for create Card-type dialog
     var cardTypeDialogOptions = jQuery.extend({}, dialogOptions);
     cardTypeDialogOptions.buttons = {
        "Add": function() {
            if(! blockIfEmpty('#cardtype #name', 'Card name')){
                $(this).dialog("close");
                createCardType();
            }            
        },
        "Cancel": function() {
            $(this).dialog("close");
        }
    };

    // Setup options for create Card-type dialog
    // extending from Card-type dialog
    var statusDialogOptions =  jQuery.extend(true, {}, cardTypeDialogOptions);
     statusDialogOptions.buttons.Add = function() {
        if(! blockIfEmpty('#status #name', 'Workflow Status name ')){
            $(this).dialog("close");
            createWorkflowStatus()
        }
    };

     $('#cardtype-dialog').dialog(cardTypeDialogOptions);
     $('#status-dialog').dialog(statusDialogOptions);
}

function cardTypeDeleteConfirmation(id)
{
    // Setup actions for yes/no button
    $('#confirm-dialog').dialog('option', 'buttons', {
        "No"  : function() {$(this).dialog("close");},
        "Yes" : function() {
            deleteCardType(id);
            $(this).dialog("close");
        }
    });

    var msg  = "Are sure to delete this card type? <br />";
        msg += '<span class="small"><b>Note: </b>Cards with this type will be changed to <i>defaultCardType</i><br />';
        msg += 'Check /common/config.php for details.</span>';
    showConfirmation('Delete Card Type', msg);
    return false;
}

function statusDeleteConfirmation(id)
{
    // Setup actions for yes/no button
    $('#confirm-dialog').dialog('option', 'buttons', {
        "No"  : function() {$(this).dialog("close");},
        "Yes" : function() {
            deleteStatus(id);
            $(this).dialog("close");
        }
    });
    
    var msg  = "Are sure to delete this workflow state? <br />";
        msg += '<span class="small"><b>Note: </b>Cards on this workflow state will be changed to <i>defaultStatus</i><br />';
        msg += 'Check /common/config.php for details.</span>';
    showConfirmation('Delete Workflow State', msg);
    return false;
}



function deleteCardType(id)
{
    if(id == ''){
        showCommonError('Error occured', 'Empty card type found!');
    } else{
        $.getJSON("common/ajax_settings.php?action=deleteCardType&id=" + id,
            function(data){
                if(data.status == 'success'){
                    $('#type-' + id).remove();
                } else {
                    showCommonError('Error occured', data.message);
                }
            }
        );// ended $.getJSON
    }

    return false;
}

function deleteStatus(id)
{
    if(id == ''){
        showCommonError('Error occured', 'Empty workflow status id found!');
    } else{
        $.getJSON("common/ajax_settings.php?action=deleteStatus&id=" + id,
            function(data){
                if(data.status == 'success'){
                    $('#status-' + id).remove();
                } else {
                    showCommonError('Error occured', data.message);
                }
            }
        );// ended $.getJSON
    }

    return false;
}

// Swap the position of a workflow status with right side one
function upStatusSl(id)
{
    $.getJSON("common/ajax_settings.php?action=upSerial&id=" + id,
        function(data){
            if(data.status == 'success'){
                $('#status-'+id).after($('#status-'+id).prev());
            } else {
                showCommonError('Error occured', data.message);
            }
        }
    );// ended $.getJSON
}

// Swap the position of a workflow status with left side one
function downStatusSl(id)
{
    $.getJSON("common/ajax_settings.php?action=downSerial&id=" + id,
        function(data){
            if(data.status == 'success'){
                $('#status-'+id).before($('#status-'+id).next());
            } else {
                showCommonError('Error occured', data.message);
            }
        }
    );// ended $.getJSON
}

function makeCardTypeRow(id)
{
    var row = '<tr id="type-'+ id +'" class="ui-state-default">';
    row += '    <td id="card_types-name-'+id+'" class="editable">'+ $('#cardtype #name').val() +'</td>';
    row += '    <td id="card_types-front_color-'+id+'" class="editable" align="center">'+ $('#front_color').val() +'</td>';
    row += '    <td id="card_types-back_color-'+id+'" class="editable" align="center">'+ $('#back_color').val() +'</td>';
    row += '    <td class="action" align="center">';
    row += '        <a class="ui-link ui-state-default ui-corner-all" onclick="return cardTypeDeleteConfirmation(\''+id+'\')" href="#delete">';
    row += '            <span class="ui-icon ui-icon-trash"/> delete </a>';
    row += '    </td>';
    row += '</tr>';

    return row;
}

function makeStatusRow(id)
{
    var row = '<tr id="status-'+ id +'" class="ui-state-default">';
    row += '    <td id="status_names-name-'+id+'"  class="editable">'+ $('#status #name').val() +'</td>';
    row += '    <td id="status_names-WIP-'+id+'"  class="editable" align="center">'+ $('#status #WIP').val() +'</td>';
    row += '    <td id="status_names-WIP_column-'+id+'"  class="editable" align="center">1</td>';
    row += '    <td class="action"  align="center"';
    row += '        <a class="ui-link ui-state-default ui-corner-all" onclick="return downStatusSl(\''+id+'\')" href="#down">';
    row += '            <span class="ui-icon ui-icon-arrowthick-1-s"/> Down</a>';
    row += '        <a class="ui-link ui-state-default ui-corner-all" onclick="return upStatusSl(\''+id+'\')" href="#up">';
    row += '            <span class="ui-icon ui-icon-arrowthick-1-n"/> Up</a>';
    row += '        <a class="ui-link ui-state-default ui-corner-all" onclick="return statusDeleteConfirmation(\''+id+'\')" href="#delete">';
    row += '            <span class="ui-icon ui-icon-trash"/> Delete</a>';
    row += '    </td>';
    row += '</tr>';

    return row;
}

function createCardType()
{
    $.getJSON("common/ajax_settings.php?action=addCardType&" + $('#cardtype').serialize(),
        function(data){
            if(data.status == 'success'){
                $('#card-types tbody').append(makeCardTypeRow(data.message));
                $('#cardtype input').val("");
            } else {
                showCommonError('Error occured', data.message);
            }
        }
    );// ended $.getJSON
}

function createWorkflowStatus()
{
    $.getJSON("common/ajax_settings.php?action=addStatus&" + $('#status').serialize(),
        function(data){
            if(data.status == 'success'){
                $('#status-names tbody tr:last').before(makeStatusRow(data.message));
                $('#status input').val("");
            } else {
                showCommonError('Error occured', data.message);
            }
        }
    );// ended $.getJSON
}