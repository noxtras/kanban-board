
function bindPageEvents(){

    // Make the table columns Sortable
    $('#card-table tbody td').sortable({
        connectWith: '#card-table tbody td',
        cursor: 'pointer',
        receive: function(event, ui) {
            // Handle card moving
            status = $(event.target).attr('id').substr('status-'.length);
            card = ui.item.attr('id').substr('card-'.length);
            savePosition(card, status);
        }
    });

    // Make column width fixed, except first and last column
    width = parseInt($('.card:first').css('width')) + 4;
    $('tr.state-names th').css('width', width+'px');
    $('tr.state-names th:first, tr.state-names th:last').css({"min-width": width+'px', "width": 'auto'});

    // On card dialog box, make the card content inline editable
    $('.active-card').editable('common/ajax_cards.php', {
         indicator  : 'Saving...',
         submitdata : {action: "updateCard"},
         cssclass   : 'editing',
         type       : 'textarea',
         rows       : 4,
         submit     : "Save",
         cancel     : "Cancel"
     });

    // When duble click on a card, open it on Card dialog
    $('.card').live('dblclick', (function(){
        $('#card-dialog .active-card').html($(this).find('.full-text').html());
        $('#card-dialog .active-card').attr('id', $(this).attr('id').substr('card-'.length));
        $('#card-dialog .info').text($(this).find('.info').text());
        $('#card-dialog').dialog('open');
    }));

    // Setup card dialog, extending from default dialog options
    var cardDialogOptions = jQuery.extend({}, dialogOptions);
    cardDialogOptions.width = 550;
    cardDialogOptions.height = 350;
    cardDialogOptions.buttons = {
        "Close": function() {
            $(this).dialog("close");
            checkAndApplyChanges();
        }
    };

    // On click of "Add New Card" button,
    // swap "Create-card form" and "card type legend"
    $('#create-card').click(function(){
        $('#card-form').slideToggle('fast');
        $('#type-legend').slideToggle('fast');
        if($('#create-card').text().indexOf('Add New Card') != -1){
            $('#create-card').html('<span class="ui-icon ui-icon-minusthick"></span>Hide Form');
            $('#title').focus();
        } else {
            $('#create-card').html('<span class="ui-icon ui-icon-plusthick"></span>Add New Card');
        }
        
        return false;
    })

    $('#card-dialog').dialog(cardDialogOptions);

}

function createCard()
{
    if(! blockIfEmpty('#title', 'Card title')){
        var url = "common/ajax_cards.php?action=createCard&" + $('#card-form').serialize();

        $.getJSON(url,
          function(data){
                if(data.status == 'success'){
                    $('#status-' + config.defaultStatus)
                        .append(createCardHtml(data.message));
                    $('#title').val("");
                } else {
                    showCommonError('Error occured', data.message);
                }
            }
        );// ended $.getJSON
    }

    return false;
}

// When a card is moved to another column, save new position
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

// If a Card is successfully created,
// make html to put it on the board
function createCardHtml(id)
{
    var content = $('#title').val();
    var contentShort = content.substr(0, config.miniCardLength);
    var type = $('#card_type').val();
    if(content.length > config.miniCardLength) contentShort += '...';

    var html  = '<div id="card-'+ id +'" class="card card-type-'+ type +'">';
    html     += '   <span class="short-text">'+ contentShort +'</span>';
    html     += '   <span class="full-text invisible">'+ content +'</span>';
    html     += '   <span class="info invisible">Created right now!</span>';
    html     += '</div>'

    return html;
}

// When card dialog is closing,
// this function checks if active card (which is opened on the board)
// content has changed.
// If changed, take steps to reflact the change on board
function checkAndApplyChanges()
{
    var editingCard = $('#card-dialog .active-card');
    var id          = editingCard.attr('id');
    var fullHtml    = editingCard.find('textarea').val();

    if(fullHtml == undefined){ // not on editing state
        fullHtml  = editingCard.html();
    }

    if($('#card-' + id + ' .full-text').html() != fullHtml){
        var shortText = fullHtml.split('<br>').join('\n').substring(0, config.miniCardLength);
        $('#card-' + id + ' .short-text').text(shortText);
        $('#card-' + id + ' .full-text').html(fullHtml);
    }

    // Reset
    $('#card-dialog .active-card').text('');
    $('#card-dialog .active-card').attr('id', 'no-card');
}