
function bindPageEvents(){
    $('.project-name').editable('common/ajax.php', {
         indicator  : 'Saving...',
         submitdata : {action: "renameProject"},
         cssclass   : 'editing'
     });
}


function createProject()
{
    if(! blockIfEmpty('project')){
        $.getJSON("common/ajax.php?action=createProject&" + $('#projectForm').serialize(),
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
        $.getJSON("common/ajax.php?action=deleteProject&id=" + id,
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
        $.getJSON("common/ajax.php?action=updateProjectStatus&id=" + id + '&status='+ status,
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
    var row  = '<tr id="project-'+ id +'">';
    row += '<td><span class="project-name editable" id='+ id +'">'+ name +'</span></td>';
    row += '<td>0</td><td>0</td>';
    row += '<td><a href="?page=project&id='+ id +'">go</a> <a href="#">archive</a> <a href="#">delete</a> </td>';
    row += '</tr>';

    return row;
}