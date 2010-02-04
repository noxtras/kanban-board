<?php

include_once 'ajax.php';

function deleteCard()
{
    $cardId  = intval($_GET['id']);
    deleteRowById($cardId, 'cards');
}

function createCard()
{
    global $config;
    
    $title     = strval($_GET['title']);
    $type_id   = strval($_GET['card_type']);
    $projectId = strval($_GET['project']);
    if(empty($title)) return response('error', 'Empty card title not allowed');

    // Insert card
    try{
        $data = array('body'=> $title,
                      'project_id'=> $projectId,
                      'card_type_id'=> $type_id,
                      'status_id'=> $config['defaultStatus'],
                      'create_date'=> time()
            );
        Db::execute("INSERT INTO cards(body, project_id, status_id, card_type_id, create_date)
                     VALUES(:body, :project_id, :status_id, :card_type_id, :create_date)", $data);

        $insertId = Db::getLastInsertId();
        if($insertId) return response('success', $insertId);
    } catch (Exception $e){
        return response('error', $e->getMessage());
    }

}

function savePosition()
{
    $card  = intval($_GET['card']);
    $status = intval($_GET['status']);

    // update card
    try{
        $updated = updateTableFieldById('cards','status_id', $status, $card);
        if($updated) return response('success', $updated);
    } catch (Exception $e){
        return response('error', $e->getMessage());
    }
}

function updateCard()
{
    $cardId  = intval($_POST['id']);
    $body    = trim(strip_tags(stripcslashes(strval($_POST['value']))));

    updateJEditableField('cards','body', $body, $cardId);
}