
function bindPageEvents(){
    $('#card-table tbody td').sortable({
        connectWith: '#card-table tbody td',
        cursor: 'pointer',
        receive: function(event, ui) {
            status = $(event.target).attr('id').substr('status-'.length);
            card = ui.item.attr('id').substr('card-'.length);
            savePosition(card, status);
        }
    });

    $('.active-card').editable('common/ajax_cards.php', {
         indicator  : 'Saving...',
         submitdata : {action: "updateCard"},
         cssclass   : 'editing',
         type       : 'textarea',
         rows       : 4,
         submit     : "Save",
         cancel     : "Cancel"
     });

    $('.card').live('dblclick', (function(){
        $('#card-dialog .active-card').html($(this).find('.full-text').html());
        $('#card-dialog .active-card').attr('id', $(this).attr('id').substr('card-'.length));
        $('#card-dialog .info').text($(this).find('.info').text());
        $('#card-dialog').dialog('open');
    }));

    var cardDialogOptions = jQuery.extend({}, dialogOptions);
    cardDialogOptions.width = 550;
    cardDialogOptions.height = 350;
    cardDialogOptions.buttons = {
        "Close": function() {
            $(this).dialog("close");

            var fullHtml  = $('#card-dialog .active-card').html();
            var shortText = fullHtml.split('<br>').join('\n').substring(0, config.miniCardLength);
            var id        = $('#card-dialog .active-card').attr('id');

            $('#card-' + id + ' .short-text').text(shortText);
            $('#card-' + id + ' .full-text').html(fullHtml);

            // Reset
            $('#card-dialog .active-card').text('');
            $('#card-dialog .active-card').attr('id', 'no-card');
        }
    };

    $('#create-card').click(function(){
        $('#cardForm').slideToggle('fast');
        $('#type-legend').slideToggle('fast');
        if($('#create-card').text().indexOf('Add New Card') != -1){
            $('#create-card').html('<span class="ui-icon ui-icon-minusthick"></span>Hide Form');
        } else {
            $('#create-card').html('<span class="ui-icon ui-icon-plusthick"></span>Add New Card');
        }


        return false;
    })

    $('#card-dialog').dialog(cardDialogOptions);

}

function createCard()
{
    if(! blockIfEmpty('title')){
        var url = "common/ajax_cards.php?action=createCard&" + $('#cardForm').serialize();

        $.getJSON(url,
          function(data){
                if(data.status == 'success'){
                    $('#status-' + config.defaultStatus)
                        .append('<div class="card card-type-'+ $('#card_type').val() +'" id="card-'+ data.message +'">'+ $('#title').val() +'</div>');
                        $('#title').val("");
                } else {
                    showCommonError('Error occured', data.message);
                }
            }
        );// ended $.getJSON


    }

    return false;
}

function savePosition(card, status)
{
    var url  = 'common/ajax_cards.php?action=savePosition';
    url     += '&card='  + card;
    url     += '&status=' + status;

    $.getJSON(url, null,
      function(data){
        if((typeof data != 'object') || data.status != 'success'){
                showCommonError('Error occured', data.message);
            }
        }
    );// ended $.get
}

function cardDeleteConfirmation()
{
    id = $('#card-dialog .active-card').attr('id');
    $('#confirm-dialog').dialog('option', 'buttons', {
        "No"  : function() {$(this).dialog("close");},
        "Yes" : function() {
            deleteCard(id);
            $(this).dialog("close");
            $('#card-dialog').dialog("close");
        }
    });
    showConfirmation('Delete Card', 'Are sure to delete this card?');
    return false;
}

function deleteCard(id)
{
    if(id == 'no-card'){
        showCommonError('Error occured', 'No active to delete!');
    } else{
        $.getJSON("common/ajax_cards.php?action=deleteCard&id=" + id,
            function(data){
                if(data.status == 'success'){
                    $('#card-' + id).remove();
                } else {
                    showCommonError('Error occured', data.message);
                }
            }
        );// ended $.getJSON
    }

    return false;
}