<?php

include_once 'ajax.php';

function saveSettings()
{
    list ($table, $field, $id) = explode('-', $_POST['id']);
    $value = strval($_POST['value']);

    $updated = updateJEditableField($table, $field, $value, $id);
}

function deleteCardType()
{
    global $config;

    $cardTypeId  = intval($_GET['id']);
    // Move cards of this type to default card type
    Db::execute("UPDATE cards SET card_type_id = {$config['defaultCardType']}
                 WHERE card_type_id = $cardTypeId");
    deleteRowById($cardTypeId, 'card_types');
}

function deleteStatus()
{
    global $config;

    $statusId  = intval($_GET['id']);
    // Move cards under this status to default status
    Db::execute("UPDATE cards SET status_id = {$config['defaultStatus']}
                 WHERE status_id = $statusId");
    deleteRowById($statusId, 'status_names');
}

function upSerial()
{
    $id = intval($_GET['id']);
    $currentRow = Db::getRow("SELECT id, serial FROM status_names WHERE id = $id");

    $minimum = Db::getValue("SELECT MIN(serial) from status_names");

    if($currentRow['serial'] != $minimum){
        $prevRow = Db::getRow("SELECT id, serial from status_names where serial < {$currentRow['serial']} ORDER BY serial DESC LIMIT 1");
        $swap = _swapWorkflowState($prevRow, $currentRow);
        if($swap instanceof Exception){
            response('error', $swap->getMessage());
        } else {
            response('success', $prevRow['id']);
        }
    } else {
        response('error', 'No more up step allowed!');
    }
}

function downSerial()
{
    $id = intval($_GET['id']);
    $currentRow = Db::getRow("SELECT id, serial FROM status_names WHERE id = $id");
    $maximum = Db::getValue("SELECT MAX(serial) from status_names");

    if($currentRow['serial'] < $maximum){
        $nextRow = Db::getRow("SELECT id, serial from status_names where serial > {$currentRow['serial']} ORDER BY serial LIMIT 1");
        $swap = _swapWorkflowState($nextRow, $currentRow);
        if($swap instanceof Exception){
            response('error', $swap->getMessage());
        } else {
            response('success', 'Swap successful!');
        }
    } else {
        response('error', 'No more down step allowed!');
    }
}

function _swapWorkflowState($stateA, $stateB)
{
    try{
        Db::beginTransaction();
        Db::execute("UPDATE status_names SET serial = {$stateA['serial']} WHERE id = {$stateB['id']}");
        Db::execute("UPDATE status_names SET serial = {$stateB['serial']} WHERE id = {$stateA['id']}");
        Db::commitTransaction();
    } catch (Exception $e){
        Db::rollbackTransaction();
        return $e;
    }
}

function addCardType()
{
    unset($_GET['action']);
    try{
        Db::execute("INSERT INTO card_types(name, front_color, back_color)
                     VALUES(:name, :front_color, :back_color)", $_GET);
        response('success', Db::getLastInsertId());
    } catch (Exception $e){
        response('error', $e->getMessage());
    }
}

function addStatus()
{
    unset($_GET['action']);

    try{
        Db::execute("INSERT INTO status_names(name, WIP, serial)
            VALUES(:name, :WIP, (select max(id) from status_names) + 1)", $_GET);
        response('success', Db::getLastInsertId());
    } catch (Exception $e){
        response('error', $e->getMessage());
    }
}
