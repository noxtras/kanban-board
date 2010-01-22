<?php

function updateTableFieldById($table, $field, $value, $id)
{
    $data = array('id'=>$id, 'value'=>$value);
    return Db::execute("UPDATE $table SET $field = :value WHERE id = :id", $data);
}

// Project related functions

function getProject($projectId)
{
    if(is_numeric($projectId)){
        return Db::getRow('SELECT * FROM projects WHERE id = ?', $projectId);
    }

    return false;
}

function getProjects($status = 'active')
{
    return Db::getResult('SELECT * FROM projects WHERE status = ?', $status);
}

// Card Related functions


// Settings and other properties
function getStatusNames()
{
    return Db::getResult('SELECT * FROM status_names ORDER BY serial');
}

function getCardTypes()
{
    return Db::getResult('SELECT * FROM card_types');
}

// Utility Functions

/**
 * Replace the 1st level indexs of a 2D array
 * by each elements $indexBy index
 *
 * @param array $array
 * @param string $indexBy OPTIONAL default = id
 * @return array
 */
function indexArray($array, $indexBy = 'id')
{
    $output = array();

    foreach($array as $item){
        $output[$item[$indexBy]] = $item;
    }

    return $output;
}
