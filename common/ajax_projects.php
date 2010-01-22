<?php
include_once 'ajax.php';

function renameProject()
{
    $projectId  = intval($_POST['id']);
    $name       = trim(strval($_POST['value']));

    updateJEditableField('projects','name', $name, $projectId);
}

function deleteProject()
{
    $projectId  = intval($_GET['id']);

    $data = array('id'=>$projectId, 'name'=>$name);
    $deleted = Db::execute('DELETE FROM projects WHERE id = ?', $projectId);

    return ($deleted)
        ? response('success', $projectId)
        : response('error', 'Project not deleted! Please try again.');
}

function updateProjectStatus()
{
    $projectId  = intval($_GET['id']);
    $status     = trim(strval($_GET['status']));

    if(in_array($status, array('active', 'archived'))){
        $updated = updateTableFieldById('projects','status', $status, $projectId);
        if($updated) return response('success', $updated);
    }

    response('error', 'Project not updated! Please try again.');
}

function createProject()
{
    $name = strval($_GET['project']);
    if(empty($name)) return response('error', 'Empty project name');

    $exist = Db::getValue('SELECT count(id) from projects where name= ?', $name);
    if($exist) return response('error', 'Project name already exist');

    // Insert project
    $data = array('name'=>$name, 'status'=>'active');
    Db::execute('INSERT INTO projects(name, status) VALUES(:name, :status)', $data);

    $insertId = Db::getLastInsertId();
    if($insertId) return response('success', $insertId);

    return response('error', 'Something went wrong! please try again.');
}