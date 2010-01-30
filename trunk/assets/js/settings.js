
function bindPageEvents(){
    $('table#card-types td.editable, table#status-names td.editable').editable('common/ajax_settings.php', {
         indicator  : 'Saving...',
         submitdata : {action: "saveSettings"},
         cssclass   : 'editing'
     });

     var cardTypeDialogOptions = dialogOptions;
     cardTypeDialogOptions.width = 550;
     cardTypeDialogOptions.buttons = {
        "Add": function() {
            if(! blockIfEmpty('cardtype #name', 'Card name')){
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
                $(this).dialog("close");
            }
            
        },
        "Cancel": function() {
            $(this).dialog("close");
        }
    };

    var statusDialogOptions = cardTypeDialogOptions;
     statusDialogOptions.buttons.Add = function() {
            if(! blockIfEmpty('status #name', 'Workflow Status name ')){
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
                $(this).dialog("close");
            }

        };

     $('#cardtype-dialog').dialog(cardTypeDialogOptions);
     $('#status-dialog').dialog(statusDialogOptions);
}

function cardTypeDeleteConfirmation(id)
{
    $('#confirm-dialog').dialog('option', 'buttons', {
        "No"  : function() {$(this).dialog("close");},
        "Yes" : function() {
            deleteCardType(id);
            $(this).dialog("close");}
    });
    var msg  = "Are sure to delete this card type? <br />";
        msg += '<span class="small"><b>Note: </b>Cards with this type will be changed to <i>defaultCardType</i></span>';
    showConfirmation('Delete Card Type', msg);
    return false;
}

function statusDeleteConfirmation(id)
{
    $('#confirm-dialog').dialog('option', 'buttons', {
        "No"  : function() {$(this).dialog("close");},
        "Yes" : function() {
            deleteStatus(id);
            $(this).dialog("close");}
    });
    var msg  = "Are sure to delete this workflow state? <br />";
        msg += '<span class="small"><b>Note: </b>Cards with this state will be moved to <i>defaultStatus</i></span>';
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
    var row = '<tr id="type-'+ id +'">';
    row += '    <td id="card_types-name-'+id+'">'+ $('#cardtype #name').val() +'</td>';
    row += '    <td id="card_types-front_color-'+id+'">'+ $('#front_color').val() +'</td>';
    row += '    <td id="card_types-back_color-'+id+'">'+ $('#back_color').val() +'</td>';
    row += '    <td class="action">';
    row += '        <a onclick="return cardTypeDeleteConfirmation(\''+id+'\')" href="#delete">Delete</a>';
    row += '    </td>';
    row += '</tr>';

    return row;
}

function makeStatusRow(id)
{
    var row = '<tr id="status-'+ id +'">';
    row += '    <td id="status_names-name-'+id+'" class="editable">'+ $('#status #name').val() +'</td>';
    row += '    <td id="status_names-WIP-'+id+'" class="editable">'+ $('#status #WIP').val() +'</td>';
    row += '    <td id="status_names-WIP_column-'+id+'" class="editable">1</td>';
    row += '    <td class="action"';
    row += '        <a onclick="return downStatusSl(\''+id+'\')" href="#up">Down</a>';
    row += '        <a onclick="return upStatusSl(\''+id+'\')" href="#down">Up</a>';
    row += '        <a onclick="return statusDeleteConfirmation(\''+id+'\')" href="#delete">Delete</a>';
    row += '    </td>';
    row += '</tr>';

    return row;
}