
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
                            //$('#type-' + id).remove();
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

     $('#cardtype-dialog').dialog(cardTypeDialogOptions);
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