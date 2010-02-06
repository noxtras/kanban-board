
function bindPageEvents(){
    $('.project-name').editable('common/ajax_projects.php', {
         indicator  : 'Saving...',
         submitdata : {action: "renameProject"},
         cssclass   : 'editing'
     });

     $(".project-progress").each(function(i, obj){
        $(this).progressbar({ value: $(this).attr('title')});
     });

     var projectDialogOptions = jQuery.extend({}, dialogOptions);
     projectDialogOptions.buttons = {
        "Add": function() {
            if(createProject()){
                $(this).dialog("close");
            }
        },
        "Cancel": function() {
            $(this).dialog("close");
        }
    };
    $('#project-dialog').dialog(projectDialogOptions);
}

function createProject()
{
    if(! blockIfEmpty('project', 'Project name ')){
        $.getJSON("common/ajax_projects.php?action=createProject&" + $('#projectForm').serialize(),
          function(data){
                if(data.status == 'success'){
                    $('#projet-list tbody')
                        .prepend(makeProjectRow(data.message, $('#project').val()));
                    $('#project').val("");
                } else {
                    showCommonError('Error occured', data.message);
                }
            }
        );// ended $.get
        return true;
    }

    return false;
}

function projectDeleteConfirmation(id)
{
    $('#confirm-dialog').dialog('option', 'buttons', {
        "No"  : function() { $(this).dialog("close"); },
        "Yes" : function() {
            deleteProject(id);
            $(this).dialog("close");}
    });
    showConfirmation('Delete Project', 'Are sure to delete this project?');
    return false;
}

function deleteProject(id)
{
    if(id == ''){
        showCommonError('Error occured', 'Empty project found!');
    } else{
        $.getJSON("common/ajax_projects.php?action=deleteProject&id=" + id,
            function(data){
                if(data.status == 'success'){
                    $('#project-' + id).remove();
                } else {
                    showCommonError('Error occured', data.message);
                }
            }
        );// ended $.getJSON
    }
    
    return false;
}

function updateProjectStatus(id, status)
{
    if(id == '' || (status != 'active' && status != 'archived')){
        showCommonError('Error occured', 'Empty project id or invalid status found!');
    } else{
        $.getJSON("common/ajax_projects.php?action=updateProjectStatus&id=" + id + '&status='+ status,
            function(data){
                if(data.status == 'success'){
                    $('#project-' + id).remove();
                } else {
                    showCommonError('Error occured', data.message);
                }
            }
        );// ended $.getJSON
    }

    return false;
}

function makeProjectRow(id, name)
{
    var row  = '<tr id="project-'+ id +'"  class="ui-state-default">';
    row += '    <td><span class="project-name" id='+ id +'">'+ name +'</span></td>';
    row += '    <td>&nbsp;</td>';
    row += '    <td><a class="ui-link ui-state-default ui-corner-all" href="?page=project&id='+ id +'">';
    row += '        <span class="ui-icon ui-icon-folder-open"/>go';
    row += '    </a></td>';
    row += '</tr>';

    return row;
}