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
    $cardTypeId  = intval($_GET['id']);
    deleteRowById($cardTypeId, 'card_types');
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
