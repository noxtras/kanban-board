<?php
include_once 'prepend.php';

if(function_exists($_REQUEST['action'])){
    $_REQUEST['action']();
}

function deleteRowById($id, $table)
{
    try{
        Db::execute("DELETE FROM $table WHERE id = ?", $id);
        response('success', $id);
    } catch (Exception $e){
        response('error', $e->getMessage());
    }
}

function updateJEditableField($table, $field, $value, $id)
{
    $data = array('id'=>$id, 'value'=>$value);
    try{
        Db::execute("UPDATE $table SET $field = :value WHERE id = :id", $data);
        echo nl2br($value);
    } catch (Exception $e){
        echo 'Error occured';
    }
}

function response($status, $message)
{
    echo json_encode(array('status' => $status, 'message' => $message));
    return true;
}
