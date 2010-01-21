// Global settings vars
defaultStatusId = '1';

$(document).ready(function(){

    $('#dialog').dialog({
        autoOpen: false,
        resizable: false,
        width: 350,
        buttons: {
            "Ok": function() {$(this).dialog("close");}
        }
    });

    $('#confirm-dialog').dialog({
        autoOpen: false,
        resizable: false,
        width: 300,
        modal: true,
        buttons: {}
    });

    $(".editable").hover(
      function () { $(this).addClass('edit-focus'); },
      function () { $(this).removeClass('edit-focus'); }
    );


    if(typeof bindPageEvents  == 'function') {
    	bindPageEvents();
    }
});

function blockIfEmpty(field)
{
    if($('#' + field).val() == ''){
        showCommonError('Value required', field + ' cannot be empty!');
        return true;
    }

    return false;
}

function showCommonDialog(title, message, icon)
{
    var title   = title   || 'Error!';
    var message = message || 'Something was wrong! Please try again later.';
    var icon    = icon    || 'info';
    var iconspan    = '<span style="margin: 0pt 7px 50px 0pt; float: left;" class="ui-icon ui-icon-'+ icon +'"> </span>';

	$('#dialog').dialog('option', 'title', title);
    $('#dialog').html('<p>' + iconspan + message + '</p>').dialog('open');
}

function showCommonError(title, message)
{
	var title   = title   || 'Error!';
    var message = message || 'Something was wrong! Please try again later.';
	showCommonDialog(title, message, 'circle-close');
}

// From Jhon Resig
Array.prototype.remove = function(from, to) {
  var rest = this.slice((to || from) + 1 || this.length);
  this.length = from < 0 ? this.length + from : from;
  return this.push.apply(this, rest);
};

function showConfirmation(title, message)
{
	var title   = title   || 'Warning!';
    var message = message || 'Are you sure to do this?';
    var iconspan    = '<span style="margin: 0pt 7px 50px 0pt; float: left;" class="ui-icon ui-icon-alert"> </span>';

    $('#confirm-dialog').dialog('option', 'title', title);
    $('#confirm-dialog').html('<p>' + iconspan + message + '</p>').dialog('open');
}

