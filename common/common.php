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
    global $config;
    
    return Db::getResult("SELECT  p.*, count(DISTINCT c1.id) total_card, count(DISTINCT c2.id) done_card
                            FROM  projects p
                       LEFT JOIN  cards c1 ON p.id = c1.project_id
                       LEFT JOIN  cards c2 ON p.id = c2.project_id
                                    AND c2.status_id = :card_status
                           WHERE  p.status = :project_status
                           GROUP  BY p.id
                           ORDER  BY p.id DESC",
            array('card_status' => $config['doneStatus'], 'project_status' => $status)
        );
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

function printCard($card)
{
    global $config;
    $bodyText = stripcslashes($card['body']);

    echo '<span class="short-text">';
    echo substr($bodyText, 0, $config['miniCardLength']);
    if(strlen($bodyText) > $config['miniCardLength']) echo '...';
    echo '</span>';
    echo '<span class="full-text invisible">', nl2br($bodyText) ,'</span>';
    echo '<span class="info invisible">Created on: ', date('Y-m-d H:i A', $card['create_date'])  ,'</span>';
}
