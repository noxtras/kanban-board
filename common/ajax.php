<?php
include_once 'prepend.php';

if(function_exists($_REQUEST['action'])){
    $_REQUEST['action']();
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

function createCard()
{
    $title     = strval($_GET['title']);
    $projectId = strval($_GET['project']);
    if(empty($title)) return response('error', 'Empty card title not allowed');

    // Insert card
    $data = array('body'=>$title, 'project_id'=>$projectId, 'status_id'=>'1');
    Db::execute('INSERT INTO cards(body, project_id, status_id) VALUES(:body, :project_id, :status_id)', $data);

    $insertId = Db::getLastInsertId();
    if($insertId) return response('success', $insertId);

    return response('error', 'Something went wrong! please try again.');
}

function savePosition()
{
    $card  = intval($_GET['card']);
    $status = intval($_GET['status']);

    // update card
    $updated = updateTableFieldById('cards','status_id', $status, $card);
    if($updated) return response('success', $updated);

    return response('error', 'Something went wrong! please try again.');
}

function updateCard()
{
    $cardId  = intval($_POST['id']);
    $body    = trim(strval($_POST['value']));

    $updated = updateTableFieldById('cards','body', $body, $cardId);

    echo ($updated)? stripcslashes($body) : 'Error occured! Please try again.';
}

function deleteCard()
{
    $cardId  = intval($_GET['id']);

    $data = array('id'=>$projectId, 'name'=>$name);
    $deleted = Db::execute('DELETE FROM cards WHERE id = ?', $cardId);

    return ($deleted)
        ? response('success', $cardId)
        : response('error', 'Card not deleted! Please try again.');
}

function renameProject()
{
    $projectId  = intval($_POST['id']);
    $name       = trim(strval($_POST['value']));

    $updated = updateTableFieldById('projects','name', $name, $projectId);

    echo ($updated)? stripcslashes($name) : 'Error occured! Please try again.';
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

function response($status, $message)
{
    echo json_encode(array('status' => $status, 'message' => $message));
    return true;
}
