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
