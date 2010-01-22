
function bindPageEvents(){
    $('table#card-types td.editable').editable('common/ajax_settings.php', {
         indicator  : 'Saving...',
         submitdata : {action: "saveSettings"},
         cssclass   : 'editing'
     });
}

function cardTypeDeleteConfirmation(id)
{
    $('#confirm-dialog').dialog('option', 'buttons', {
        "No"  : function() { $(this).dialog("close"); },
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