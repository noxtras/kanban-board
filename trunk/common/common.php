<?php

function updateTableFieldById($table, $field, $value, $id)
{
    $data = array('id'=>$id, 'value'=>$value);
    return Db::execute("UPDATE $table SET $field = :value WHERE id = :id", $data);
}

